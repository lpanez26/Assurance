var {getWeb3, getContractInstance} = require('./helper');

basic.init();

$(document).ready(function() {

    App.init();
});

$(window).on('load', function() {

});

$(window).on('resize', function(){

});

$(window).on('scroll', function()  {

});

//on button click next time when you hover the button the color is bugged until you click some other element (until you move out the focus from this button)
function fixButtonsFocus() {
    if($('a').length > 0) {
        $('a').click(function() {
            $(this).blur();
        });
    }
}
fixButtonsFocus();

function generateUrl(str)  {
    var str_arr = str.split('');
    var cyr = [
        'Ð°','Ð±','Ð²','Ð³','Ð´','Ðµ','Ñ‘','Ð¶','Ð·','Ð¸','Ð¹','Ðº','Ð»','Ð¼','Ð½','Ð¾','Ð¿',
        'Ñ€','Ñ','Ñ‚','Ñƒ','Ñ„','Ñ…','Ñ†','Ñ‡','Ñˆ','Ñ‰','ÑŠ','Ñ‹','ÑŒ','Ñ','ÑŽ','Ñ',
        'Ð','Ð‘','Ð’','Ð“','Ð”','Ð•','Ð','Ð–','Ð—','Ð˜','Ð™','Ðš','Ð›','Ðœ','Ð','Ðž','ÐŸ',
        'Ð ','Ð¡','Ð¢','Ð£','Ð¤','Ð¥','Ð¦','Ð§','Ð¨','Ð©','Ðª','Ð«','Ð¬','Ð­','Ð®','Ð¯',' '
    ];
    var lat = [
        'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
        'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
        'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
        'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya','-'
    ];
    for(var i = 0; i < str_arr.length; i+=1)  {
        for(var y = 0; y < cyr.length; y+=1)    {
            if(str_arr[i] == cyr[y])    {
                str_arr[i] = lat[y];
            }
        }
    }
    return str_arr.join('').toLowerCase();
}

function checkIfCookie()    {
    if($('.privacy-policy-cookie').length > 0)  {
        $('.privacy-policy-cookie .accept').click(function()    {
            basic.cookies.set('privacy_policy', 1);
            $('.privacy-policy-cookie').hide();
        });
    }
}

//binding the refresh captcha event to existing button
function initCaptchaRefreshEvent()  {
    if($('.refresh-captcha').length > 0)    {
        $('.refresh-captcha').click(function()  {
            $.ajax({
                type: 'GET',
                url: '/refresh-captcha',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.captcha-container span').html(response.captcha);
                }
            });
        });
    }
} 

var global_state = {};
var temporally_timestamp = 0;
var App = {
    assurance_address: "0x7d0278788bedc4767bb469ea7d143787a133c4a0",
    assurance_abi: [{"constant":false,"inputs":[{"name":"_patient_addr","type":"address"},{"name":"_dentist_addr","type":"address"}],"name":"breakContract","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_api_decimals","type":"uint256"}],"name":"changeApiDecimals","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_api_result_dcn_usd_price","type":"uint256"}],"name":"changeApiResultDcnUsdPrice","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_min_allowed_amount","type":"uint256"}],"name":"changeMinimumAllowedAmount","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_period_to_withdraw","type":"uint256"}],"name":"changePeriodToWithdraw","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_usd_over_dcn","type":"bool"}],"name":"changeUsdOverDcn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"circuitBreaker","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_patient_addr","type":"address"}],"name":"dentistApproveContract","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_dentist_addr","type":"address"}],"name":"patientApproveContract","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_patient_addr","type":"address"},{"name":"_dentist_addr","type":"address"},{"name":"_value_usd","type":"uint256"},{"name":"_value_dcn","type":"uint256"},{"name":"_date_start_contract","type":"uint256"},{"name":"_contract_ipfs_hash","type":"string"}],"name":"registerContract","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"registerDentist","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_new_admin","type":"address"}],"name":"transferAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_new_owner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_array","type":"address[]"}],"name":"withdrawToDentist","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_dentist_addr","type":"address"},{"indexed":true,"name":"_patient_addr","type":"address"},{"indexed":false,"name":"_value","type":"uint256"},{"indexed":false,"name":"_date","type":"uint256"}],"name":"logSuccessfulWithdraw","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_dentist_addr","type":"address"},{"indexed":false,"name":"_date","type":"uint256"}],"name":"logSuccessfulDentistRegistration","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_dentist_addr","type":"address"},{"indexed":true,"name":"_patient_addr","type":"address"},{"indexed":false,"name":"_date","type":"uint256"},{"indexed":false,"name":"_value_usd","type":"uint256"},{"indexed":false,"name":"_value_dcn","type":"uint256"}],"name":"logSuccessfulContractRegistration","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_dentist_addr","type":"address"},{"indexed":true,"name":"_patient_addr","type":"address"},{"indexed":false,"name":"_date","type":"uint256"}],"name":"logSuccessfulContractBreak","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_patient_addr","type":"address"},{"indexed":true,"name":"_dentist_addr","type":"address"}],"name":"logSuccessfulContractApproval","type":"event"},{"constant":true,"inputs":[],"name":"admin","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"api_decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"api_result_dcn_usd_price","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"AssuranceContract","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"contract_paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_dentist_addr","type":"address"}],"name":"getDentist","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDentistsArr","outputs":[{"name":"","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_patient_addr","type":"address"},{"name":"_dentist_addr","type":"address"}],"name":"getPatient","outputs":[{"name":"","type":"address"},{"name":"","type":"address"},{"name":"","type":"uint256"},{"name":"","type":"bool"},{"name":"","type":"bool"},{"name":"","type":"bool"},{"name":"","type":"uint256"},{"name":"","type":"uint256"},{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_dentist_addr","type":"address"}],"name":"getPatientsArrForDentist","outputs":[{"name":"","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_patient_addr","type":"address"}],"name":"getWaitingContractsForPatient","outputs":[{"name":"","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"min_allowed_amount","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"period_to_withdraw","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"usd_over_dcn","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"}],
    assurance_instance: null,
    dentacoin_token_address: "0x19f49a24c7cb0ca1cbf38436a86656c2f30ab362",
    dentacoin_token_abi: [{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"buyDentacoinsAgainstEther","outputs":[{"name":"amount","type":"uint256"}],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[],"name":"haltDirectTrade","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amountOfEth","type":"uint256"},{"name":"dcn","type":"uint256"}],"name":"refundToOwner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"sellDentacoinsAgainstEther","outputs":[{"name":"revenue","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newDCNAmount","type":"uint256"}],"name":"setDCNForGas","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newBuyPriceEth","type":"uint256"},{"name":"newSellPriceEth","type":"uint256"}],"name":"setEtherPrices","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newGasAmountInWei","type":"uint256"}],"name":"setGasForDCN","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newGasReserveInWei","type":"uint256"}],"name":"setGasReserve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"minimumBalanceInWei","type":"uint256"}],"name":"setMinBalance","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"unhaltDirectTrade","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_owner","type":"address"},{"indexed":true,"name":"_spender","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Approval","type":"event"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"buyPriceEth","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"DCNForGas","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"DentacoinAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"directTradeAllowed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"gasForDCN","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"gasReserve","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"minBalanceForAccounts","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"sellPriceEth","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}],
    dentacoin_instance: null,
    web3Provider: null,
    web3_0_2: null,
    web3_1_0: null,
    clinics_holder: null,
    contracts: {},
    loading: false,
    init: function() {
        return App.initWeb3();
    },
    initWeb3: async function()    {
        /*if(localStorage.getItem('current-account') != null && typeof(web3) === 'undefined')    {
            //CUSTOM
            global_state.account = JSON.parse(localStorage.getItem('current-account')).address;
            App.web3_1_0 = getWeb3(new Web3.providers.HttpProvider('https://mainnet.infura.io/c6ab28412b494716bc5315550c0d4071'));
        }else */if(typeof(web3) !== 'undefined') {
            //METAMASK
            App.web3_0_2 = web3;
            global_state.account = App.web3_0_2.eth.defaultAccount;
            //overwrite web3 0.2 with web 1.0
            web3 = getWeb3(App.web3_0_2.currentProvider);
            //web3 = getWeb3(new Web3.providers.HttpProvider('https://rinkeby.infura.io/v3/c6ab28412b494716bc5315550c0d4071'));
            App.web3_1_0 = web3;
        }else {
            //NO CUSTOM, NO METAMASK. Doing this final third check so we can use web3_1_0 functions and utils even if there is no metamask or custom imported/created account
            App.web3_1_0 = getWeb3();
        }

        //if user is not logged in with metamask or custom stop here
        if(typeof(global_state.account) != 'undefined') {
            return App.initContract();
        }
    },
    initContract: async function() {
        //Assurance
        App.assurance_instance = new App.web3_1_0.eth.Contract(App.assurance_abi, App.assurance_address);
        //DentacoinToken
        App.dentacoin_token_instance = new App.web3_1_0.eth.Contract(App.dentacoin_token_abi, App.dentacoin_token_address);

        //save current block number into state
        await App.helper.getBlockNum();

        //init pages logic
        pagesDataOnContractInit();
    },
    dentacoin_token_methods: {
        allowance: function(owner, spender)  {
            return App.dentacoin_token_instance.methods.allowance(owner, spender).call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    return result;
                }else {
                    console.error(error);
                }
            });
        },
        approve: function()  {
            return App.dentacoin_token_instance.methods.approve(App.assurance_address, 9000000000000).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        }
    },
    assurance_methods: {
        getDentist: function(dentist_addr)  {
            return App.assurance_instance.methods.getDentist(dentist_addr).call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    return result;
                }else {
                    console.error(error);
                }
            });
        },
        getPatient: function(patient_addr, dentist_addr)  {
            return App.assurance_instance.methods.getPatient(patient_addr, dentist_addr).call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    return result;
                }else {
                    console.error(error);
                }
            });
        },
        getDentistsArr: function()  {
            return App.assurance_instance.methods.getDentistsArr().call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    console.log(result);
                }else {
                    console.error(error);
                }
            });
        },
        getPatientsArrForDentist: function(dentist_addr)  {
            return App.assurance_instance.methods.getPatientsArrForDentist(dentist_addr).call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    return result;
                }else {
                    console.error(error);
                }
            });
        },
        getWaitingContractsForPatient: function(patient_addr)  {
            return App.assurance_instance.methods.getWaitingContractsForPatient(patient_addr).call({ from: global_state.account }, function(error, result)   {
                if(!error)  {
                    return result;
                }else {
                    console.error(error);
                }
            });
        },
        breakContract: function(patient_addr, dentist_addr)  {
            //check if patient and dentist addresses are valid
            if(!innerAddressCheck(patient_addr) || !innerAddressCheck(dentist_addr)) {
                basic.showAlert('Patient and dentist addresses must be valid.');
                return false;
            }
            //CHECK IF THERE IS CONTRACT BETWEEN THEM?????
            return App.assurance_instance.methods.breakContract(patient_addr, dentist_addr).send({
                from: global_state.account,
                gas: 130000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        },
        dentistApproveContract: function(patient_addr)  {
            //check if patient address is valid
            if(!innerAddressCheck(patient_addr)) {
                basic.showAlert('Patient address must be valid.');
                return false;
            }
            return App.assurance_instance.methods.dentistApproveContract(patient_addr).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        },
        patientApproveContract: function(dentist_addr)  {
            return App.assurance_instance.methods.patientApproveContract(dentist_addr).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        },
        registerContract: async function(patient_addr, dentist_addr, value_usd, value_dcn, date_start_contract, contract_ipfs_hash)  {
            var check_if_dentist_registered = await App.assurance_methods.getDentist(dentist_addr);
            //check if patient and dentist addresses are valid
            if(!innerAddressCheck(patient_addr) || !innerAddressCheck(dentist_addr)) {
                basic.showAlert('Patient and dentist addresses must be valid.');
                return false;
            }
            //check if dentist is registered on Assurance contract
            if(check_if_dentist_registered.toLowerCase() != dentist_addr.toLowerCase()) {
                basic.showAlert('You are not registered dentist on the Assurance contract. In order to init contracts you must first register your self.');
                return false;
            }
            //(talk with Jeremias about this check) check if patient gave allowance to Assurance contract to manage his Dentacoins
            if(parseInt(await App.dentacoin_token_methods.allowance(patient_addr, App.assurance_address)) <= 0) {
                basic.showAlert('This patient didn\'t give allowance to Assurance contract to manage his Dentacoins.');
                return false;
            }
            //check if USD and DCN values are valid
            if(parseInt(value_usd) <= 0 || parseInt(value_dcn) <= 0) {
                basic.showAlert('Both USD and DCN values must be greater than 0.');
                return false;
            }
            //check if valid timestamp
            if(date_start_contract < 0) {
                basic.showAlert('Please enter valid date.');
                return false;
            }
            return App.assurance_instance.methods.registerContract(patient_addr, dentist_addr, value_usd, value_dcn, date_start_contract, contract_ipfs_hash).send({
                from: global_state.account,
                gas: 330000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        },
        registerDentist: function()  {
            return App.assurance_instance.methods.registerDentist().send({
                from: global_state.account,
                gas: 100000
            }).on('transactionHash', function(hash){
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function(err) {
                console.error(err);
            });
        },
        withdrawToDentist: async function()  {
            var ready_to_withdraw_arr = [];
            var current_patients_for_dentist = await App.assurance_methods.getPatientsArrForDentist(global_state.account);
            if(current_patients_for_dentist.length > 0) {
                for (var i = 0, len = current_patients_for_dentist.length; i < len; i += 1) {
                    var patient = await App.assurance_methods.getPatient(current_patients_for_dentist[i], global_state.account);
                    //if time passed for next_transfer of contract and if the contract is approved by both patient and dentist and then dentist can withdraw from patient legit
                    console.log(patient);
                    if(Math.round(new Date().getTime() / 1000) > parseInt(patient[2]) && patient[3] && patient[4]) {
                        ready_to_withdraw_arr.push(patient[1]);
                    }
                }
            }

            if(ready_to_withdraw_arr.length > 0) {
                return App.assurance_instance.methods.withdrawToDentist(ready_to_withdraw_arr).send({
                    from: global_state.account,
                    gas: ready_to_withdraw_arr.length * 60000
                }).on('transactionHash', function(hash){
                    basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/'+hash+'" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
                }).catch(function(err) {
                    console.error(err);
                });
            }else {
                basic.showAlert('At this moment you don\'t have any possible withdraws (no running contracts or not ready to withdraw contracts).');
                return false;
            }
        }
    },
    events: {

    },
    helper: {
        addBlockTimestampToTransaction: function(transaction)    {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.getBlock(transaction.blockNumber, function(error, result) {
                    if (error !== null) {
                        reject(error);
                    }
                    temporally_timestamp = result.timestamp;
                    resolve(temporally_timestamp);
                });
            });
        },
        getLoopingTransactionFromBlockTimestamp: function(block_num)    {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.getBlock(block_num, function(error, result) {
                    if (error !== null) {
                        reject(error);
                    }
                    resolve(result.timestamp);
                });
            });
        },
        getBlockNum: function()  {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.getBlockNumber(function(error, result) {
                    if(!error){
                        global_state.curr_block = result;
                        resolve(global_state.curr_block);
                    }
                });
            });
        },
        getAccounts: function()  {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.getAccounts(function(error, result) {
                    if(!error){
                        resolve(result);
                    }
                });
            });
        },
        estimateGas: function(address, function_abi)  {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.estimateGas({
                    to: address,
                    data: function_abi
                }, function(error, result) {
                    if(!error){
                        resolve(result);
                    }
                });
            });
        },
        getGasPrice: function() {
            return new Promise(function(resolve, reject) {
                App.web3_1_0.eth.getGasPrice(function(error, result) {
                    if(!error){
                        resolve(result);
                    }
                });
            });
        },
        getAddressETHBalance: function(address)    {
            return new Promise(function(resolve, reject) {
                resolve(App.web3_1_0.eth.getBalance(address));
            });
        }
    }
};

async function pagesDataOnContractInit() {
    if($('body').hasClass('dentist')) {
        $('.additional-info .current-account a').html(global_state.account).attr('href', 'https://rinkeby.etherscan.io/address/' + global_state.account);
        $('.additional-info .assurance-account a').html(App.assurance_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.assurance_address);
        $('.additional-info .dentacointoken-account a').html(App.dentacoin_token_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.dentacoin_token_address);
        var check_dentist_account = await App.assurance_methods.getDentist(global_state.account);
        if(check_dentist_account.toLowerCase() == global_state.account.toLowerCase()) {
            $('.additional-info .is-dentist span').addClass('yes').html('YES');
        }else {
            $('.additional-info .is-dentist span').addClass('no').html('NO'); 
        }

        //show current pending and running contracts
        buildCurrentDentistContractHistory();

        $('.register-dentist').click(function() {
            App.assurance_methods.registerDentist();
        });

        $('.register-contract').click(function()    {
            App.assurance_methods.registerContract($('.registerContract .patient-address').val().trim(), global_state.account, $('.registerContract .value-usd').val().trim(), $('.registerContract .value-dcn').val().trim(), new Date($('.registerContract .date-start-contract').val().trim()).getTime() / 1000, $('.registerContract .ipfs-hash').val().trim());
        });

        $('.dentist-approve-contract').click(function() {
            App.assurance_methods.dentistApproveContract($('.dentistApproveContract .patient-address').val().trim());
        });

        $('.withdraw-to-dentist').click(function() {
            App.assurance_methods.withdrawToDentist();
        });

        $('.break-contract').click(function() {
            App.assurance_methods.breakContract($('.breakContract .patient-address').val().trim(), global_state.account);
        });
    }else if($('body').hasClass('patient')) {
        $('.additional-info .current-account a').html(global_state.account).attr('href', 'https://rinkeby.etherscan.io/address/' + global_state.account);
        $('.additional-info .assurance-account a').html(App.assurance_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.assurance_address);
        $('.additional-info .dentacointoken-account a').html(App.dentacoin_token_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.dentacoin_token_address);

        //we check greater than 0 or more?????? ASK JEREMIAS
        if(parseInt(await App.dentacoin_token_methods.allowance(global_state.account, App.assurance_address)) > 0) {
            $('.is-allowance-given span').addClass('yes').html('YES');
        }else {
            $('.is-allowance-given span').addClass('no').html('NO');
        }

        //show current pending and running contracts
        buildCurrentPatientContractHistory();

        $('.approve .approve-dcntoken-contract').click(function() {
            App.dentacoin_token_methods.approve();
        });

        $('.register-contract').click(function()    {
            App.assurance_methods.registerContract(global_state.account, $('.registerContract .dentist-address').val().trim(), $('.registerContract .value-usd').val().trim(), $('.registerContract .value-dcn').val().trim(), new Date($('.registerContract .date-start-contract').val().trim()).getTime() / 1000, $('.registerContract .ipfs-hash').val().trim());
        });

        $('.patient-approve-contract').click(function() {
            App.assurance_methods.patientApproveContract($('.patientApproveContract .dentist-address').val().trim());
        });

        $('.break-contract').click(function() {
            App.assurance_methods.breakContract(global_state.account, $('.breakContract .dentist-address').val().trim());
        });
    }
}

function initDateTimePicker() {
    if($(".form_datetime").length > 0) {
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    }
}
initDateTimePicker();

//checking if passed address is valid
function innerAddressCheck(address)    {
    return App.web3_1_0.utils.isAddress(address);
}

async function buildCurrentDentistContractHistory() {
    var current_patients_for_dentist = await App.assurance_methods.getPatientsArrForDentist(global_state.account);
    if(current_patients_for_dentist.length > 0) {
        var pending_approval_from_this_dentist_bool = false;
        var pending_approval_from_patient = false;
        var running_contacts_bool = false;
        for(var i = 0, len = current_patients_for_dentist.length; i < len; i+=1) {
            var patient = await App.assurance_methods.getPatient(current_patients_for_dentist[i], global_state.account);
            var single_patient_body = '<div class="single"><div><label>Patient address:</label> <a href="https://rinkeby.etherscan.io/address/'+patient[1]+'" target="_blank" class="etherscan-hash">'+patient[1]+'</a></div><div><label>USD value:</label> '+patient[6]+'</div><div><label>DCN value:</label> '+patient[7]+'</div><div><label>IPFS link: (this is where patient and dentist can see the real contract (pdf) signed between them) <a href="https://gateway.ipfs.io/ipfs/'+patient[8]+'" target="_blank">https://gateway.ipfs.io/ipfs/'+patient[8]+'</a></label></div>';
            if(patient[3] == true && patient[4] == true) {
                if(!running_contacts_bool) {
                    $('.running-contacts .fieldset-body').html('');
                    running_contacts_bool = true;
                }
                single_patient_body+='<div><label>Date and time for next available withdraw:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.running-contacts .fieldset-body').append(single_patient_body);
            }else if(patient[3] == true) {
                if(!pending_approval_from_patient) {
                    $('.pending-approval-from-patient .fieldset-body').html('');
                    pending_approval_from_patient = true;
                }
                single_patient_body+='<div><label>Date and time contract start:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.pending-approval-from-patient .fieldset-body').append(single_patient_body);
            }else if(patient[4] == true) {
                if(!pending_approval_from_this_dentist_bool) {
                    $('.pending-approval-from-this-dentist .fieldset-body').html('');
                    pending_approval_from_this_dentist_bool = true;
                }
                single_patient_body+='<div><label>Date and time contract start:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.pending-approval-from-this-dentist .fieldset-body').append(single_patient_body);
            }
        }
    }
}

async function buildCurrentPatientContractHistory() {
    var current_dentists_for_patient = await App.assurance_methods.getWaitingContractsForPatient(global_state.account);
    if(current_dentists_for_patient.length > 0) {
        var pending_approval_from_this_dentist_bool = false;
        var pending_approval_from_patient = false;
        var running_contacts_bool = false;
        for(var i = 0, len = current_dentists_for_patient.length; i < len; i+=1) {
            var patient = await App.assurance_methods.getPatient(global_state.account, current_dentists_for_patient[i]);
            var single_patient_body = '<div class="single"><div><label>Dentist address:</label> <a href="https://rinkeby.etherscan.io/address/'+patient[0]+'" target="_blank" class="etherscan-hash">'+patient[0]+'</a></div><div><label>USD value:</label> '+patient[6]+'</div><div><label>DCN value:</label> '+patient[7]+'</div><div><label>IPFS link:  (this is where patient and dentist can see the real contract (pdf) signed between them) <a href="https://gateway.ipfs.io/ipfs/'+patient[8]+'" target="_blank">https://gateway.ipfs.io/ipfs/'+patient[8]+'</a></label></div>';
            if(patient[3] == true && patient[4] == true) {
                if(!running_contacts_bool) {
                    $('.running-contacts .fieldset-body').html('');
                    running_contacts_bool = true;
                }
                single_patient_body+='<div><label>Date and time for next available withdraw:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.running-contacts .fieldset-body').append(single_patient_body);
            }else if(patient[3] == true) {
                if(!pending_approval_from_patient) {
                    $('.pending-approval-from-this-patient .fieldset-body').html('');
                    pending_approval_from_patient = true;
                }
                single_patient_body+='<div><label>Date and time contract start:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.pending-approval-from-this-patient .fieldset-body').append(single_patient_body);
            }else if(patient[4] == true) {
                if(!pending_approval_from_this_dentist_bool) {
                    $('.pending-approval-from-dentist .fieldset-body').html('');
                    pending_approval_from_this_dentist_bool = true;
                }
                single_patient_body+='<div><label>Date and time contract start:</label> '+new Date(parseInt(patient[2])*1000)+'</div></div>';
                $('.pending-approval-from-dentist .fieldset-body').append(single_patient_body);
            }
        }
    }
}

// ================== PAGES ==================
if($('body').hasClass('home')) {
    if($('.testimonials-slider').length > 0) {
        $('.testimonials-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            adaptiveHeight: true
        });
    }

    if($('.open-calculator').length > 0) {
        $('.open-calculator').click(function() {
            $.ajax({
                type: 'POST',
                url: '/get-calculator-html',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success) {
                        basic.closeDialog();
                        basic.showDialog(response.success, 'calculator-popup', null, true);
                        $('.selectpicker').selectpicker('refresh');
                        fixButtonsFocus();

                        calculateLogic();
                    }
                }
            });
        });
    }
}else if($('body').hasClass('patient-access')) {
    if($('.ask-your-dentist-for-assurance').length) {
        $('.ask-your-dentist-for-assurance').click(function() {
            $('html, body').animate({scrollTop: $('#find-your-dentist').offset().top}, 500);
            $('#find-your-dentist .search-dentist-input').focus();
            return false;
        });
    }
}else if($('body').hasClass('support-guide')) {
    if($('.support-guide-slider').length) {
        $('.support-guide-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 3
        });
    }

    if($('.section-support-guide-list .question').length > 0) {
        $('.section-support-guide-list .question').click(function()   {
            $(this).closest('li').find('.question-content').toggle(300);
        });
    }
}else if($('body').hasClass('wallet-instructions')) {
    if($('.section-wallet-instructions-questions .question').length > 0) {
        $('.section-wallet-instructions-questions .question').click(function()   {
            $(this).toggleClass('active');
            $(this).closest('li').find('.question-content').toggle(300);
        });
    }
}

//LOGGED USER LOGIC
if($('body').hasClass('logged-in')) {
    if($('body').hasClass('edit-account')) {
        styleAvatarUploadButton();

        $('form#patient-update-profile').on('submit', function(event) {
            var this_form = $(this);
            var errors = false;
            //clear prev errors
            if(this_form.find('.error-handle').length) {
                this_form.find('.error-handle').remove();
            }

            var form_fields = this_form.find('.custom-input');
            var dentist_login_errors = false;
            for(var i = 0, len = form_fields.length; i < len; i+=1) {
                if(form_fields.eq(i).attr('type') == 'email' && !basic.validateEmail(form_fields.eq(i).val().trim())) {
                    customErrorHandle(form_fields.eq(i).parent(), 'Please use valid email address.');
                    dentist_login_errors = true;
                } else if(form_fields.eq(i).attr('type') == 'password' && form_fields.eq(i).val().length < 6) {
                    customErrorHandle(form_fields.eq(i).parent(), 'Passwords must be min length 6.');
                    dentist_login_errors = true;
                }

                if(form_fields.eq(i).val().trim() == '') {
                    customErrorHandle(form_fields.eq(i).parent(), 'This field is required.');
                    dentist_login_errors = true;
                }
            }

            if(errors) {
                event.preventDefault();
            }
        });
    }
}

//THIS IS FUNCTIONALITY ONLY FOR LOGGED IN USERS
if($('body').hasClass('logged-in')) {
    $('.logged-user > a, .logged-user .hidden-box').hover(function(){
        $('.logged-user .hidden-box').show();
    }, function(){
        $('.logged-user .hidden-box').hide();
    });
}

function calculateLogic() {
    $('.calculate').click(function() {
        var patients_number = $('#number-of-patients').val();
        var params_type;
        if($('#general-dentistry').is(':checked') && $('#cosmetic-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_gd_cd_id';
        } else if($('#general-dentistry').is(':checked') && $('#cosmetic-dentistry').is(':checked')) {
            params_type = 'param_gd_cd';
        } else if($('#general-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_gd_id';
        } else if($('#cosmetic-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_cd_id';
        } else if($('#general-dentistry').is(':checked')) {
            params_type = 'param_gd';
        } else if($('#cosmetic-dentistry').is(':checked')) {
            params_type = 'param_cd';
        } else if($('#implant-dentistry').is(':checked')) {
            params_type = 'param_id';
        }

        var country = $('#country').val();
        var currency = $('#currency').val();

        if(patients_number == '' || parseInt(patients_number) <= 0) {
            basic.showAlert('Please enter valid number of patients per day.', '', true);
            return false;
        } else if(params_type == undefined) {
            basic.showAlert('Please select specialties.', '', true);
            return false;
        } else if(country == undefined) {
            basic.showAlert('Please select country.', '', true);
            return false;
        } else if(currency == undefined) {
            basic.showAlert('Please select currency.', '', true);
            return false;
        }
        var calculator_data = {
            'patients_number' : patients_number.trim(),
            'params_type' : params_type,
            'country' : country.trim(),
            'currency' : currency.trim()
        };

        $.ajax({
            type: 'POST',
            url: '/get-calculator-result',
            dataType: 'json',
            data: calculator_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                basic.closeDialog();
                basic.showDialog(response.success, 'calculator-result-popup', null, true);
                fixButtonsFocus();

                $('.calculate-again').click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '/get-calculator-html',
                        dataType: 'json',
                        data: calculator_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.success) {
                                basic.closeDialog();
                                basic.showDialog(response.success, 'calculator-popup', null, true);
                                $('.selectpicker').selectpicker('refresh');
                                fixButtonsFocus();

                                calculateLogic();
                            }
                        }
                    });
                });
            }
        });
    });
}

function customJavascriptForm(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

//call the popup for login/sign for patient and dentist
function bindLoginSigninPopupShow() {
    if($('.show-login-signin').length) {
        $('.show-login-signin').click(function() {
            $.ajax({
                type: 'POST',
                url: '/get-login-signin',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: async function (response) {
                    if(response.success) {
                        basic.closeDialog();
                        basic.showDialog(response.success, 'login-signin-popup', null, true);

                        $('.popup-header-action a').click(function() {
                            $('.login-signin-popup .popup-body > .inline-block').addClass('custom-hide');
                            $('.login-signin-popup .popup-body .'+$(this).attr('data-type')).removeClass('custom-hide');
                        });

                        $('.login-signin-popup .call-sign-up').click(function() {
                            $('.login-signin-popup .form-login').hide();
                            $('.login-signin-popup .form-register').show();
                        });

                        $('.login-signin-popup .call-log-in').click(function() {
                            $('.login-signin-popup .form-login').show();
                            $('.login-signin-popup .form-register').hide();
                        });

                        // ====================== PATIENT LOGIN/SIGNUP LOGIC ======================

                        //login
                        $('.patient .form-register #privacy-policy-registration-patient').on('change', function() {
                            if($(this).is(':checked')) {
                                $('.patient .form-register .facebook-custom-btn').removeAttr('custom-stopper');
                                $('.patient .form-register .civic-custom-btn').removeAttr('custom-stopper');
                            } else {
                                $('.patient .form-register .facebook-custom-btn').attr('custom-stopper', 'true');
                                $('.patient .form-register .civic-custom-btn').attr('custom-stopper', 'true');
                            }
                        });

                        $(document).on('civicCustomBtnClicked', async function (event) {
                            $('.patient .form-register .step-errors-holder').html('');
                        });

                        $(document).on('facebookCustomBtnClicked', async function (event) {
                            $('.patient .form-register .step-errors-holder').html('');
                        });

                        $(document).on('customCivicFbStopperTriggered', async function (event) {
                            customErrorHandle($('.patient .form-register .step-errors-holder'), 'Please agree with our privacy policy.');
                        });
                        // ====================== /PATIENT LOGIN/SIGNUP LOGIC ======================

                        // ====================== DENTIST LOGIN/SIGNUP LOGIC ======================

                        //login
                        $('form#dentist-login').on('submit', function(event) {
                            //clear prev errors
                            if($('form#dentist-login .error-handle').length) {
                                $('form#dentist-login .error-handle').remove();
                            }

                            var form_fields = $(this).find('.custom-input');
                            var dentist_login_errors = false;
                            for(var i = 0, len = form_fields.length; i < len; i+=1) {
                                if(form_fields.eq(i).attr('type') == 'email' && !basic.validateEmail(form_fields.eq(i).val().trim())) {
                                    customErrorHandle(form_fields.eq(i).parent(), 'Please use valid email address.');
                                    dentist_login_errors = true;
                                } else if(form_fields.eq(i).attr('type') == 'password' && form_fields.eq(i).val().length < 6) {
                                    customErrorHandle(form_fields.eq(i).parent(), 'Passwords must be min length 6.');
                                    dentist_login_errors = true;
                                }

                                if(form_fields.eq(i).val().trim() == '') {
                                    customErrorHandle(form_fields.eq(i).parent(), 'This field is required.');
                                    dentist_login_errors = true;
                                }
                            }

                            if(dentist_login_errors) {
                                event.preventDefault();
                            }
                        });

                        //register
                        $('.dentist .form-register .prev-step').click(function() {
                            var current_step = $('.dentist .form-register .step.visible');
                            var current_prev_step = current_step.prev();
                            current_step.removeClass('visible');
                            if(current_prev_step.hasClass('first')) {
                                $(this).hide();
                            }
                            current_prev_step.addClass('visible');

                            $('.dentist .form-register .next-step').attr('data-current-step', current_prev_step.attr('data-step'));
                        });

                        //SECOND STEP INIT LOGIC
                        //load address script
                        await $.getScript('/assets/js/address.js', function() {});

                        $('#dentist-country').on('change', function() {
                            $('.step.second .phone .country-code').html('+'+$(this).find('option:selected').attr('data-code'));
                        });

                        //THIRD STEP INIT LOGIC
                        styleAvatarUploadButton();
                        initCaptchaRefreshEvent();

                        $('.dentist .form-register .next-step').click(function() {
                            var this_btn = $(this);
                            if(this_btn.attr('data-current-step') == 'third') {
                                this_btn.val('Create profile');
                            }else {
                                this_btn.val('Next');
                            }

                            switch(this_btn.attr('data-current-step')) {
                                case 'first':
                                    var first_step_inputs = $('.dentist .form-register .step.first .custom-input');
                                    var errors = false;
                                    $('.dentist .form-register .step.first').parent().find('.error-handle').remove();
                                    for(var i = 0, len = first_step_inputs.length; i < len; i+=1) {
                                        if(first_step_inputs.eq(i).attr('type') == 'email' && !basic.validateEmail(first_step_inputs.eq(i).val().trim())) {
                                            customErrorHandle(first_step_inputs.eq(i).parent(), 'Please use valid email address.');
                                            errors = true;
                                        } else if(first_step_inputs.eq(i).attr('type') == 'password' && first_step_inputs.eq(i).val().length < 6) {
                                            customErrorHandle(first_step_inputs.eq(i).parent(), 'Passwords must be min length 6.');
                                            errors = true;
                                        }

                                        if(first_step_inputs.eq(i).val().trim() == '') {
                                            customErrorHandle(first_step_inputs.eq(i).parent(), 'This field is required.');
                                            errors = true;
                                        }
                                    }

                                    if($('.dentist .form-register .step.first .custom-input.password').val().trim() != $('.step.first .custom-input.repeat-password').val().trim()) {
                                        customErrorHandle($('.step.first .custom-input.repeat-password').parent(), 'Both passwords don\'t match.');
                                        errors = true;
                                    }

                                    if(!errors) {
                                        $('.dentist .form-register .step').removeClass('visible');
                                        $('.dentist .form-register .step.second').addClass('visible');
                                        $('.prev-step').show();

                                        this_btn.attr('data-current-step', 'second');
                                    }
                                    break;
                                case 'second':
                                    var second_step_inputs = $('.dentist .form-register .step.second .custom-input');
                                    var errors = false;
                                    $('.dentist .form-register .step.second').find('.error-handle').remove();

                                    //check custom-input fields
                                    for(var i = 0, len = second_step_inputs.length; i < len; i+=1) {
                                        if(second_step_inputs.eq(i).is('select')) {
                                            //IF SELECT TAG
                                            if(second_step_inputs.eq(i).val().trim() == '') {
                                                customErrorHandle(second_step_inputs.eq(i).parent(), 'This field is required.');
                                                errors = true;
                                            }
                                        }else if(second_step_inputs.eq(i).is('input')) {
                                            //IF INPUT TAG
                                            if(second_step_inputs.eq(i).val().trim() == '') {
                                                customErrorHandle(second_step_inputs.eq(i).parent(), 'This field is required.');
                                                errors = true;
                                            }

                                            if(second_step_inputs.eq(i).attr('type') == 'url' && !basic.validateUrl(second_step_inputs.eq(i).val().trim())) {
                                                customErrorHandle(second_step_inputs.eq(i).parent(), 'Please use valid website.');
                                                errors = true;
                                            }else if(second_step_inputs.eq(i).attr('type') == 'number' && !basic.validatePhone(second_step_inputs.eq(i).val().trim())) {
                                                customErrorHandle(second_step_inputs.eq(i).parent(), 'Please use valid numbers.');
                                                errors = true;
                                            }
                                        }
                                    }

                                    //check custom radio buttons
                                    if($('.dentist .form-register .step.second [name="work-type"]:checked').val() == undefined) {
                                        customErrorHandle($('.dentist .form-register .step.second .radio-buttons-holder'), 'Please select one of the options.');
                                        errors = true;
                                    } else {
                                        if($('.dentist .form-register .step.second [name="work-type"]:checked').val() == 'an-associate-dentist') {
                                            $('.dentist .form-register .step.third .search-for-clinic').html('<div class="padding-bottom-10"><select class="combobox custom-input"></select><input type="hidden" name="clinic-id"/></div>');

                                            initComboboxes();
                                            $('.dentist .form-register .step.third .search-for-clinic input[type="text"].combobox').attr('placeholder', 'Search for a clinic...');

                                            //bind the logic for the fresh appended select
                                            var timer, delay = 1000;
                                            $('.dentist .form-register .step.third .search-for-clinic input[type="text"].combobox').bind('keydown', function(e) {
                                                var this_input_val = $(this).val().trim();
                                                clearTimeout(timer);
                                                timer = setTimeout(function() {
                                                    if(this_input_val != '') {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '/get-clinics-by-name/'+this_input_val,
                                                            dataType: 'json',
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            },
                                                            success: function (response) {
                                                                if(response.success && response.success.length > 0) {
                                                                    var select_html = '<option></option>';
                                                                    for(var i = 0, len = response.success.length; i < len; i+=1) {
                                                                        select_html+='<option value="'+response.success[i].id+'">'+response.success[i].name+'</option>';
                                                                    }

                                                                    //refresh the combobox with the data received from the API
                                                                    $('.dentist .form-register .step.third .search-for-clinic select.combobox').html(select_html).combobox('refresh');
                                                                    $('.dentist .form-register .step.third .search-for-clinic input[type="text"].combobox').attr('placeholder', 'Search for a clinic...');

                                                                    //update the hidden input value on the select change
                                                                    $('.dentist .form-register .step.third .search-for-clinic select.combobox').on('change', function() {
                                                                        $('.dentist .form-register .step.third .search-for-clinic input[name="clinic-id"]').val($(this).find('option:selected').val());
                                                                    });
                                                                } else if(response.error) {
                                                                    basic.showAlert(response.error);
                                                                }
                                                            }
                                                        });
                                                    }
                                                }, delay );
                                            });
                                        } else {
                                            $('.dentist .form-register .step.third .search-for-clinic').html('');
                                        }
                                    }

                                    //check if error from google place suggester
                                    if($('.dentist .form-register .step.second .suggester-parent .alert.alert-warning').is(':visible')) {
                                        customErrorHandle($('.dentist .form-register .step.second .radio-buttons-holder'), 'Please select one of the options.');
                                        errors = true;
                                    }

                                    if(!errors) {
                                        $('.dentist .form-register .step').removeClass('visible');
                                        $('.dentist .form-register .step.third').addClass('visible');

                                        this_btn.attr('data-current-step', 'third');
                                    }
                                    break;
                                case 'third':
                                    $('.dentist .form-register .step.third').find('.error-handle').remove();
                                    var errors = false;
                                    //checking if empty avatar
                                    if($('.dentist .form-register .step.third #custom-upload-avatar').val().trim() == '') {
                                        customErrorHandle($('.step.third .step-errors-holder'), 'Please select avatar.');
                                        errors = true;
                                    }

                                    //checking if no specialization checkbox selected
                                    if($('.dentist .form-register .step.third [name="specialization[]"]:checked').val() == undefined) {
                                        customErrorHandle($('.step.third .step-errors-holder'), 'Please select specialization/s.');
                                        errors = true;
                                    }

                                    //check captcha length
                                    if($('.dentist .form-register .step.third #register-captcha').val().trim() == '' || $('.dentist .form-register .step.third #register-captcha').val().trim().length < 5) {
                                        customErrorHandle($('.step.third .step-errors-holder'), 'Please enter correct captcha.');
                                        errors = true;
                                    }

                                    //check if privacy policy checkbox is checked
                                    if(!$('.dentist .form-register .step.third #privacy-policy-registration').is(':checked')) {
                                        customErrorHandle($('.step.third .step-errors-holder'), 'Please agree with our privacy policy.');
                                        errors = true;
                                    }

                                    if(!errors) {
                                        //submit the form
                                        $('form#dentist-register').submit();
                                    }
                                    break;
                            }
                        });
                        // ====================== /DENTIST LOGIN/SIGNUP LOGIC ======================
                    }
                }
            });
        });
    }
}
bindLoginSigninPopupShow();

function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //SHOW THE IMAGE ON LOAD
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label').css({'background-image' : 'url("'+e.target.result+'")'});
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label .inner i').addClass('fs-0');
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label .inner .inner-label').addClass('fs-0');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function styleAvatarUploadButton()    {
    if(jQuery(".upload-file.avatar").length) {
        jQuery(".upload-file.avatar").each(function(key, form){
            var this_file_btn_parent = jQuery(this);
            this_file_btn_parent.find('button').append('<label for="custom-upload-avatar"><div class="inner"><i class="fa fa-plus" aria-hidden="true"></i><div class="inner-label">Add profile photo</div></div></label>');

            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function(input) {
                var label    = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function(e) {
                    readURL(this);

                    var fileName = '';
                    if(this.files && this.files.length > 1)
                        fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    /*if(fileName) {
                        if(load_filename_to_other_el)    {
                            $(this).closest('.form-row').find('.file-name').html('<i class="fa fa-file-text-o" aria-hidden="true"></i>' + fileName);
                        }else {
                            label.querySelector('span').innerHTML = fileName;
                        }
                    }else{
                        label.innerHTML = labelVal;
                    }*/
                });
                // Firefox bug fix
                input.addEventListener('focus', function(){ input.classList.add('has-focus'); });
                input.addEventListener('blur', function(){ input.classList.remove('has-focus'); });
            });
        });
    }
}

//hide bootbox popup when its clicked around him (outside of him)
function hidePopupOnBackdropClick() {
    $(document).on('click', '.bootbox', function(){
        var classname = event.target.className;
        classname = classname.replace(/ /g, '.');

        if(classname && !$('.' + classname).parents('.modal-dialog').length) {
            bootbox.hideAll();
        }
    });
}
hidePopupOnBackdropClick();

//transfer all selects to bootstrap combobox
function initComboboxes() {
    jQuery("select.combobox").each(function () {
        jQuery(this).combobox();
    });
}

function apiEventsListeners() {
    //login
    $(document).on('successResponseCoreDBApi', async function (event) {
        if(event.response_data.token) {
            var custom_form_obj = {
                token: event.response_data.token,
                email: event.response_data.data.email,
                name: event.response_data.data.name,
                address: event.response_data.data.dcn_address,
                avatar_url: event.response_data.data.avatar_url,
                have_contracts : false,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            //check if CoreDB returned address for this user and if its valid one
            if(basic.objHasKey(custom_form_obj, 'address') != null && innerAddressCheck(custom_form_obj.address)) {
                //var current_dentists_for_logging_user = await App.assurance_methods.getWaitingContractsForPatient(custom_form_obj.address);
                //if(current_dentists_for_logging_user.length > 0) {
                //custom_form_obj.have_contracts = true;
                //}
            }

            customJavascriptForm('/patient/authenticate', custom_form_obj, 'post');
        }
    });

    $(document).on('errorResponseCoreDBApi', function (event) {
        console.log(event, 'errorResponseCoreDBApi');
    });
}
apiEventsListeners();

//INIT LOGIC FOR ALL STEPS
function customErrorHandle(el, string) {
    el.append('<div class="error-handle">'+string+'</div>');
}