pragma solidity ^0.4.22;
import "github.com/oraclize/ethereum-api/oraclizeAPI.sol";

contract Ownable {
    address public owner;

    constructor() public {
        owner = msg.sender;
    }

    modifier onlyOwner() {
        if (msg.sender == owner)
            _;
    }

    function transferOwnership(address newOwner) public onlyOwner {
        if (newOwner != address(0)) owner = newOwner;
    }
}

contract SafeMath {
    /**
    * @dev Multiplies two numbers, reverts on overflow.
    */
    function mul(uint256 a, uint256 b) internal pure returns (uint256) {
        // Gas optimization: this is cheaper than requiring 'a' not being zero, but the
        // benefit is lost if 'b' is also tested.
        // See: https://github.com/OpenZeppelin/openzeppelin-solidity/pull/522
        if (a == 0) {
            return 0;
        }

        uint256 c = a * b;
        require(c / a == b);

        return c;
    }

    /**
    * @dev Integer division of two numbers truncating the quotient, reverts on division by zero.
    */
    function div(uint256 a, uint256 b) internal pure returns (uint256) {
        require(b > 0); // Solidity only automatically asserts when dividing by 0
        uint256 c = a / b;
        // assert(a == b * c + a % b); // There is no case in which this doesn't hold

        return c;
    }

    /**
    * @dev Subtracts two numbers, reverts on overflow (i.e. if subtrahend is greater than minuend).
    */
    function sub(uint256 a, uint256 b) internal pure returns (uint256) {
        require(b <= a);
        uint256 c = a - b;

        return c;
    }

    /**
    * @dev Adds two numbers, reverts on overflow.
    */
    function add(uint256 a, uint256 b) internal pure returns (uint256) {
        uint256 c = a + b;
        require(c >= a);

        return c;
    }

    /**
    * @dev Divides two numbers and returns the remainder (unsigned integer modulo),
    * reverts when dividing by zero.
    */
    function mod(uint256 a, uint256 b) internal pure returns (uint256) {
        require(b != 0);
        return a % b;
    }
}

contract ownerSettings is Ownable {
    bool public contract_paused = false;
    bool public stop_api_call = false;
    uint256 public period_to_withdraw = 180; //2 minutes for testing purpose
    //minimum allowed amount to sign a contract
    uint256 public min_allowed_amount = 8000000000000;
    //gas limit for oraclize calls
    uint256 public api_gas_limit = 200000;
    string public api_url_dcn_usd_price = "json(https://api.coingecko.com/api/v3/coins/dentacoin).market_data.current_price.usd";
    uint256 public api_result_dcn_usd_price = 16925620459000;
    uint256 public api_decimals = 17;
    uint256 public period_api_calls_range = 120;
    bool public usd_over_dcn = true;
    mapping(bytes32=>bool) valid_inner_calls;

    function circuitBreaker() public onlyOwner {
        if (contract_paused == false) { contract_paused = true; }
        else { contract_paused = false; }
    }

    function changeApiCallsAllowance() public onlyOwner {
        if (stop_api_call == false) { stop_api_call = true; }
        else { stop_api_call = false; }
    }

    function changePeriodToWithdraw(uint256 _period_to_withdraw) public onlyOwner {
        period_to_withdraw = _period_to_withdraw;
    }

    function changeMinimumAllowedAmount(uint256 _min_allowed_amount) public onlyOwner {
        min_allowed_amount = _min_allowed_amount;
    }

    function changePeriodApiCallsRange(uint256 _period_api_calls_range) public onlyOwner {
        period_api_calls_range = _period_api_calls_range;
    }

    function changeUsdOverDcn(bool _usd_over_dcn) public onlyOwner {
        usd_over_dcn = _usd_over_dcn;
    }

    // ====== API SETTERS ======
    function changeApiUrlDcnUsdPrice(string _api_url_dcn_usd_price) public onlyOwner {
        api_url_dcn_usd_price = _api_url_dcn_usd_price;
    }

    function changeApiResultDcnUsdPrice(uint256 _api_result_dcn_usd_price) public onlyOwner {
        api_result_dcn_usd_price = _api_result_dcn_usd_price;
    }

    function changeApiDecimals(uint256 _api_decimals) public onlyOwner {
        api_decimals = _api_decimals;
    }

    function changeApiGasLimit(uint256 _api_gas_limit) public onlyOwner {
        api_gas_limit = _api_gas_limit;
    }
    // ====== /API SETTERS ======
}

contract Assurance is ownerSettings, usingOraclize, SafeMath {
    // ==================================== STATE ====================================
    address public AssuranceContract = address(this);
    //DentacoinToken address
    DentacoinToken dcn = DentacoinToken(0x19f49a24c7cb0ca1cbf38436a86656c2f30ab362);

    struct patientStruct {
        uint256 next_transfer;
        bool approved;
        bool validation_checked;
        uint256 value_usd;
        uint256 value_dcn;
        uint256 index_in_patients_addresses;
    }

    struct dentistStruct {
        address addr;
        bool exists;
        address[] patients_addresses; //list of patients addresses for THIS dentist
        mapping (address => patientStruct) patients; //list of patients for THIS dentist
    }

    mapping (address => dentistStruct) dentists; //list of dentists
    address[] dentists_addresses;
    // ==================================== /STATE ====================================

    // ==================================== MODIFIERS ====================================
    modifier validPatientDentistAddresses(address _patient_addr, address _dentist_addr)  {
        //check if both patient and dentist address are valid
        require(_patient_addr != address(0) && _dentist_addr != address(0));
        //check if valid dentist and patient address are different
        require(_patient_addr != _dentist_addr);
        _;
    }

    modifier checkIfApiCallAllowed() {
        require(stop_api_call == false);
        _;
    }

    modifier checkIfPaused() {
        require(contract_paused == false);
        _;
    }
    // ==================================== /MODIFIERS ====================================

    // ==================================== EVENTS ====================================
    event logSuccessfulWithdraw(address indexed _dentist_addr, address indexed _patient_addr, uint256 _value, uint256 _date);

    event logSuccessfulDentistRegistration(address indexed _dentist_addr, uint256 _date);

    event logSuccessfulContractRegistration(address indexed _dentist_addr, address indexed _patient_addr, uint256 _date, uint256 _value_usd, uint256 _value_dcn);

    event logSuccessfulContractBreak(address indexed _dentist_addr, address indexed _patient_addr, uint256 _date);

    event logSuccessfulContractApproval(address indexed _patient_addr, address indexed _dentist_addr);
    // ==================================== /EVENTS ====================================

    // ==================================== LOGIC ====================================
    //called by patient
    function registerContract(uint256 _value_usd, uint256 _value_dcn, uint256 _date_start_contract, address _dentist_addr) public validPatientDentistAddresses(msg.sender, _dentist_addr) checkIfPaused {
        //check if this patient already allowed Assurance to use his DCN in DentacoinToken
        require(dcn.allowance(msg.sender, AssuranceContract) > min_allowed_amount);
        //check if value for USD and DCN are valid
        require(_value_usd > 0 && _value_dcn > 0);
        //check if this patient is not already registered for this dentist, so there cannot be overwrite
        require(dentists[_dentist_addr].patients[msg.sender].next_transfer == 0);

        dentists[_dentist_addr].patients[msg.sender] = patientStruct(_date_start_contract, false, false, _value_usd, _value_dcn, dentists[_dentist_addr].patients_addresses.push(msg.sender) - 1);
        emit logSuccessfulContractRegistration(_dentist_addr, msg.sender, now, _value_usd, _value_dcn);
    }

    //called by dentist
    function approveContract(address _patient_addr) public validPatientDentistAddresses(_patient_addr, msg.sender) checkIfPaused {
        dentists[msg.sender].patients[_patient_addr].approved = true;
        emit logSuccessfulContractApproval(_patient_addr, msg.sender);
    }

    //called by dentist
    function registerDentist() public checkIfPaused {
        //check if dentist is registered in the dentists mapping, so there cannot be overwrite
        require(!dentists[msg.sender].exists);

        dentists[msg.sender] = dentistStruct(msg.sender, true, new address[](0));
        dentists_addresses.push(msg.sender);
        emit logSuccessfulDentistRegistration(msg.sender, now);
    }

    //called by dentist
    function withdrawToDentist(address _patient_addr) public checkIfPaused {
        //'caching' the check for next withdraw for same patient
        if(!dentists[msg.sender].patients[_patient_addr].validation_checked) {
            //check if both patient and dentist address are valid
            require(_patient_addr != address(0) && msg.sender != address(0));
            //check if valid dentist and patient address are different
            require(_patient_addr != msg.sender);
            //check if its approved by the dentist
            require(dentists[msg.sender].patients[_patient_addr].approved);

            dentists[msg.sender].patients[_patient_addr].validation_checked = true;
        }

        //check if time passed for dentist to withdraw his dentacoins from patient
        require(now > dentists[msg.sender].patients[_patient_addr].next_transfer, "Please wait, you cannot withdraw Dentacoins yet.");

        uint256 months_num = 1;

        //time range from the last withdraw from this patient till now
        uint256 time_range = now - dentists[msg.sender].patients[_patient_addr].next_transfer;
        //adding the number of months in a row dentists didn't pull his DCN from the patient
        months_num+=div(time_range, period_to_withdraw);

        //updating next_transfer timestamp
        dentists[msg.sender].patients[_patient_addr].next_transfer = now + period_to_withdraw;

        //getting the amount that should be transfered to dentist for all the months since the contract init
        uint256 current_withdraw_amount;
        //transfer DCN to dentist
        if(usd_over_dcn) {
            //IF USD MATTERS
            //here we multiply the value_usd with 10**api_decimals, because the api_result_dcn_usd_price is multiplied earlier with 10**api_decimals. Doing this, because solidity doesn't support floats yet
            current_withdraw_amount = div(mul(dentists[msg.sender].patients[_patient_addr].value_usd, 10**api_decimals), api_result_dcn_usd_price);
            //here we multiply the amount each month with the number of months for which dentist didn't make withdraw
            current_withdraw_amount = mul(current_withdraw_amount, months_num);
        }else {
            //IF DCN MATTERS
            current_withdraw_amount = mul(dentists[msg.sender].patients[_patient_addr].value_dcn, months_num);
        }

        //transferring the DCN from patient to dentist
        dcn.transferFrom(_patient_addr, msg.sender, current_withdraw_amount);
        emit logSuccessfulWithdraw(msg.sender, _patient_addr, current_withdraw_amount, now);
    }

    //can be called from patient and dentist
    function breakContract(address _patient_addr, address _dentist_addr) public validPatientDentistAddresses(_patient_addr, _dentist_addr) checkIfPaused {
        //check if patient or dentist calling
        require(msg.sender == _patient_addr || msg.sender == _dentist_addr);
        //check if this patient is registered for this dentist
        require(dentists[_dentist_addr].patients[_patient_addr].next_transfer > 0);

        //deleting the patient address from the patients_addresses array for the current dentist
        uint256 row_to_delete = dentists[_dentist_addr].patients[_patient_addr].index_in_patients_addresses;
        address key_to_move = dentists[_dentist_addr].patients_addresses[dentists[_dentist_addr].patients_addresses.length-1];
        dentists[_dentist_addr].patients_addresses[row_to_delete] = key_to_move;
        dentists[key_to_move].patients[_patient_addr].index_in_patients_addresses = row_to_delete;
        dentists[_dentist_addr].patients_addresses.length--;

        //deleting the patient struct from the dentist patients mapping
        delete dentists[_dentist_addr].patients[_patient_addr];
        emit logSuccessfulContractBreak(_dentist_addr, _patient_addr, now);
    }

    // ====== GETTERS ======
    function getDentist(address _dentist_addr) public view returns(address) {
        return dentists[_dentist_addr].addr;
    }

    function getDentistsArr() public view returns(address[]) {
        return dentists_addresses;
    }

    function getPatient(address _patient_addr, address _dentist_addr) public view validPatientDentistAddresses(_patient_addr, _dentist_addr) returns(address, address, uint256, bool, bool, uint256, uint256) {
        patientStruct memory patient = dentists[_dentist_addr].patients[_patient_addr];
        return (_dentist_addr, _patient_addr, patient.next_transfer, patient.approved, patient.validation_checked, patient.value_usd, patient.value_dcn);
    }

    function getPatientsArrForDentist(address _dentist_addr) public view returns(address[]) {
        return dentists[_dentist_addr].patients_addresses;
    }
    // ====== /GETTERS ======

    // ====== ORACLIZE LOGIC ======
    function ownerUpdatePrice() public onlyOwner checkIfApiCallAllowed checkIfPaused {
        //first check if contract have enough balance for the api call
        if (oraclize_getPrice("URL", api_gas_limit) < address(this).balance) {
            bytes32 queryId = oraclize_query(period_api_calls_range, "URL", api_url_dcn_usd_price, api_gas_limit);
            valid_inner_calls[queryId] = true;
        }
    }

    function privateUpdatePrice() private checkIfApiCallAllowed checkIfPaused {
        //first check if contract have enough balance for the api call
        if (oraclize_getPrice("URL", api_gas_limit) < address(this).balance) {
            bytes32 queryId = oraclize_query(period_api_calls_range, "URL", api_url_dcn_usd_price, api_gas_limit);
            valid_inner_calls[queryId] = true;
        }
    }

    function __callback(bytes32 myid, string result) public checkIfApiCallAllowed checkIfPaused {
        if(!valid_inner_calls[myid]) revert();
        if(msg.sender != oraclize_cbAddress()) revert();
        api_result_dcn_usd_price = parseInt(result, api_decimals);
        delete valid_inner_calls[myid];
        privateUpdatePrice();
    }
    // ====== /ORACLIZE LOGIC ======
    // ==================================== /LOGIC ====================================
}

interface DentacoinToken {
    function balanceOf(address _owner) view returns (uint256);
    function transferFrom(address _from, address _to, uint256 _value) returns (bool success);
    function transfer(address _to, uint256 _value) returns (bool success);
    function allowance(address _owner, address _spender) view returns (uint256);
    function approve(address _spender, uint256 _value) returns (bool success);
}
