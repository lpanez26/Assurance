@extends("in-house-testing-layout")
@section("content")
    <div class="dentist-container padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center padding-bottom-20">DENTIST VIEW</h1>
                    <div class="additional-info padding-top-15 padding-bottom-30 text-center">
                        <div class="current-account">Current account: <a href="" target="_blank"></a></div>
                        <div class="is-dentist">Registered as dentist on Assurance contract: <span></span></div>
                        <div class="assurance-account">Assurance contract address: <a href="" target="_blank"></a></div>
                        <div class="dentacointoken-account">DentacoinToken contract address: <a href="" target="_blank"></a></div>
                    </div>
                    <fieldset class="margin-bottom-30">
                        <legend>Current contracts:</legend>
                        <fieldset class="margin-bottom-30 pending-approval-from-this-dentist">
                            <legend>Pending: (waiting for approval from this dentist)</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                        <fieldset class="margin-bottom-30 pending-approval-from-patient">
                            <legend>Pending: (waiting for approval from patient)</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                        <fieldset class="margin-bottom-30 running-contacts">
                            <legend>Running:</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                    </fieldset>
                    <fieldset class="margin-bottom-30">
                        <legend>registerDentist:</legend>
                        <div>
                            <button type="button" class="btn btn-primary register-dentist">Register</button>
                        </div>
                        <div class="fs-14 padding-top-10">*method is being fired without passing any parameters, the method caller is the dentist</div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 registerContract">
                        <legend>registerContract:</legend>
                        <div class="fieldset-row">
                            <label>Patient address:</label>
                            <input type="text" class="patient-address"/>
                        </div>
                        <div class="fieldset-row">
                            <label>Value USD:</label>
                            <input type="text" class="value-usd"/>
                        </div>
                        <div class="fieldset-row">
                            <label>Value DCN:</label>
                            <input type="text" class="value-dcn"/>
                        </div>
                        <div class="fieldset-row">
                            <label>Date and time contract start:</label>
                            <input type="text" class="form_datetime date-start-contract">
                        </div>
                        <div class="fieldset-row">
                            <label>IPFS HASH: (this is the link where the real pdf contract is stored in the IPFS storage)</label>
                            <input type="text" class="ipfs-hash" style="width:100%;max-width: 450px;" value="QmV9tR1p5oPLgiPbbMKWcpDsXnkTCvDT6UNcUajYWEhybn" readonly/>
                        </div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary register-contract">Register</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Patient address must be valid address.</li>
                                <li>This patient must have given allowance to Assurance contract to manage his Dentacoins.</li>
                                <li>The contract initiator must be registered dentist on the Assurance contract.</li>
                                <li>This patient and dentist must not have running contract before creating one.</li>
                                <li>USD and DCN values must be greater than 0.</li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 dentistApproveContract">
                        <legend>dentistApproveContract:</legend>
                        <div class="fieldset-row">
                            <label>Patient address:</label>
                            <input type="text" class="patient-address"/>
                        </div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary dentist-approve-contract">Approve</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Patient address must be valid address.</li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 withdrawToDentist">
                        <legend>withdrawToDentist:</legend>
                        <div class="fs-16 padding-bottom-10">Here the dApp automatically checks for which patients this dentist can make withdraw (if period for next withdraw passed). The withdraw is multiple aka one transaction for collecting the Dentacoins from all 'ready' patients. This method also calculates if for example today is July, but the dentist didn't withdraw since March => he will be payed all his Dentacoins for April, May and June from all 'ready' patients.</div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary withdraw-to-dentist">Withdraw</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Patient cannot call this method.</li>
                                <li>Contract must be approved by both dentist and patient. (On contract creation if dentist is the initiator contract is immediately approved by him or if the patient is the initiator contract is immediately aprroved by the patient. Whoever is the contract initiator is waiting for the other side to approve.)</li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 breakContract">
                        <legend>breakContract:</legend>
                        <div class="fieldset-row">
                            <label>Patient address:</label>
                            <input type="text" class="patient-address"/>
                        </div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary break-contract">Break</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Patient address must be valid address.</li>
                                <li>There must be contract running between the dentist and the patient.</li>
                            </ul>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
