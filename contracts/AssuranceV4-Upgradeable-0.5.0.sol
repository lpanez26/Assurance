pragma solidity ^0.5.0;

contract Ownable {
    address public owner;
    address public admin;

    constructor() public {
        owner = msg.sender;
        admin = msg.sender;
    }

    modifier onlyOwner() {
        require(msg.sender == owner);
        _;
    }

    modifier onlyOwnerOrAdmin() {
        require(msg.sender == owner || msg.sender == admin);
        _;
    }

    function transferOwnership(address _new_owner) public onlyOwner {
        require(_new_owner != address(0));
        owner = _new_owner;
    }

    function transferAdmin(address _new_admin) public onlyOwner {
        require(_new_admin != address(0));
        admin = _new_admin;
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
    uint256 public period_to_withdraw = 180; //3 minutes for testing purpose
    uint256 public min_allowed_amount = 8000000000000; //minimum allowed amount to sign a contract
    uint256 public api_result_dcn_usd_price = 1700000; //usd for one dcn
    uint256 public api_decimals = 10; //decimals, because solidity doesn't support float at this time
    bool public usd_over_dcn = true;

    function circuitBreaker() public onlyOwner {
        if (contract_paused == false) { contract_paused = true; }
        else { contract_paused = false; }
    }

    function changePeriodToWithdraw(uint256 _period_to_withdraw) public onlyOwner {
        period_to_withdraw = _period_to_withdraw;
    }

    function changeDentacoinTokenAddress(address _dentacoin_token_address) public onlyOwner {
        dentacoin_token_address = _dentacoin_token_address;
    }

    function changeMinimumAllowedAmount(uint256 _min_allowed_amount) public onlyOwner {
        min_allowed_amount = _min_allowed_amount;
    }

    function changeUsdOverDcn(bool _usd_over_dcn) public onlyOwner {
        usd_over_dcn = _usd_over_dcn;
    }

    // ====== PRICE SETTERS ======

    function changeApiResultDcnUsdPrice(uint256 _api_result_dcn_usd_price) public onlyOwnerOrAdmin {
        api_result_dcn_usd_price = _api_result_dcn_usd_price;
    }

    function changeApiDecimals(uint256 _api_decimals) public onlyOwner {
        api_decimals = _api_decimals;
    }
    // ====== /PRICE SETTERS ======
}

contract Assurance is ownerSettings, SafeMath {
    // ==================================== STATE ====================================
    address public AssuranceContract = address(this);
    //DentacoinToken address
    address public dentacoin_token_address = 0x19f49a24c7CB0ca1cbf38436A86656C2F30ab362;
    //DentacoinToken instance
    DentacoinToken dcn = DentacoinToken(dentacoin_token_address);

    address proxy_contract;

    struct contractStruct {
        uint256 next_transfer;
        bool approved_by_dentist;
        bool approved_by_patient;
        bool validation_checked;
        uint256 value_usd;
        uint256 value_dcn;
        string contract_ipfs_hash;
        uint256 index_in_patients_addresses;
    }

    struct dentistStruct {
        address addr;
        bool exists;
        address[] patients_addresses; //list of patients addresses for THIS dentist
        mapping (address => contractStruct) contracts; //list of contracts for THIS dentist
    }

    struct patientContractHistory {
        mapping (address => dentistSentProposal) dentists;
        address[] dentists_addresses;
    }

    struct dentistSentProposal {
        uint256 index_in_dentists_addresses;
        bool exists;
    }

    mapping (address => patientContractHistory) patient_contract_history; //incoming contracts for patient, waiting his approval
    mapping (address => dentistStruct) dentists; //list of dentists
    address[] dentists_addresses;
    // ==================================== /STATE ====================================

    // ==================================== MODIFIERS ====================================
    modifier onlyApprovedProxy() {
        require(msg.sender == proxy_contract);
        _;
    }
    // ==================================== /MODIFIERS ====================================

    // ==================================== LOGIC ====================================
    function registerDentist() onlyApprovedProxy {
        dentists[msg.sender] = dentistStruct(msg.sender, true, new address[](0));
    }

    function registerContract(address _patient_addr, address _dentist_addr, uint256 _date_start_contract, bool _approved_by_dentist, bool _approved_by_patient, bool _validation_checked, uint256 _value_usd, uint256 _value_dcn, string memory _contract_ipfs_hash) onlyApprovedProxy {
        dentists[_dentist_addr].contracts[_patient_addr] = contractStruct(_date_start_contract, _approved_by_dentist, _approved_by_patient, _validation_checked, _value_usd, _value_dcn, _contract_ipfs_hash, dentists[_dentist_addr].patients_addresses.push(_patient_addr) - 1);
    }

    function updateNextTransferTime(uint256 _next_transfer) onlyApprovedProxy {
        dentists[msg.sender].contracts[_patient_addr].next_transfer = _next_transfer;
    }

    function dentistApproveContract(address _patient_addr) {
        dentists[msg.sender].contracts[_patient_addr].approved_by_dentist = true;
        emit logSuccessfulContractApproval(_patient_addr, msg.sender);
    }

    function patientApproveContract(address _dentist_addr) {
        dentists[_dentist_addr].contracts[msg.sender].approved_by_patient = true;
        emit logSuccessfulContractApproval(msg.sender, _dentist_addr);
    }
    // ==================================== /LOGIC ====================================
}

interface DentacoinToken {
    function balanceOf(address _owner) view external returns (uint256);
    function transferFrom(address _from, address _to, uint256 _value) external returns (bool success);
    function transfer(address _to, uint256 _value) external returns (bool success);
    function allowance(address _owner, address _spender) external view returns (uint256);
    function approve(address _spender, uint256 _value) external returns (bool success);
}