@extends("in-house-testing-layout")
@section("content")
    <div class="patient-container padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center padding-bottom-20">PATIENT VIEW</h1>
                    <div class="additional-info padding-top-15 padding-bottom-30 text-center">
                        <div class="current-account">Current account address: <a href="" target="_blank"></a></div>
                        <div class="is-allowance-given">Have this patient gave allowance to Assurance contract to manage his Dentacoins: <span></span></div>
                        <div class="assurance-account">Assurance contract address: <a href="" target="_blank"></a></div>
                        <div class="dentacointoken-account">DentacoinToken contract address: <a href="" target="_blank"></a></div>
                    </div>
                    <h2 class="text-center padding-bottom-10" style="text-decoration: underline">DENTACOINTOKEN CONTACT METHODS:</h2>
                    <fieldset class="margin-bottom-30 approve">
                        <legend>approve:</legend>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary approve-dcntoken-contract">Approve</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*This way patient approve Assurance contract to manage his Dentacoins.</b>
                        </div>
                    </fieldset>
                    <h2 class="text-center padding-bottom-10" style="text-decoration: underline">ASSURANCE CONTACT METHODS:</h2>
                    <fieldset class="margin-bottom-30">
                        <legend>Current contracts:</legend>
                        <fieldset class="margin-bottom-30 pending-approval-from-this-patient">
                            <legend>Pending: (waiting for approval from this patient)</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                        <fieldset class="margin-bottom-30 pending-approval-from-dentist">
                            <legend>Pending: (waiting for approval from dentist)</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                        <fieldset class="margin-bottom-30 running-contacts">
                            <legend>Running:</legend>
                            <div class="fieldset-body">No contracts at this moment.</div>
                        </fieldset>
                    </fieldset>
                    <fieldset class="margin-bottom-30 registerContract">
                        <legend>registerContract:</legend>
                        <div class="fieldset-row">
                            <label>Dentist address:</label>
                            <input type="text" class="dentist-address"/>
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
                                <li>Patient must have given allowance to Assurance contract to manage his Dentacoins.</li>
                                <li>The contract initiator must be registered dentist on the Assurance contract.</li>
                                <li>This patient and dentist must not have running contract before creating one.</li>
                                <li>USD and DCN values must be greater than 0.</li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 patientApproveContract">
                        <legend>patientApproveContract:</legend>
                        <div class="fieldset-row">
                            <label>Dentist address:</label>
                            <input type="text" class="dentist-address"/>
                        </div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary patient-approve-contract">Approve</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Dentist address must be valid address.</li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="margin-bottom-30 breakContract">
                        <legend>breakContract:</legend>
                        <div class="fieldset-row">
                            <label>Dentist address:</label>
                            <input type="text" class="dentist-address"/>
                        </div>
                        <div class="fieldset-row">
                            <button type="button" class="btn btn-primary break-contract">Break</button>
                        </div>
                        <div class="fs-16 padding-top-10">
                            <b>*Conditions:</b>
                            <ul>
                                <li>Dentist address must be valid address.</li>
                                <li>There must be contract running between the dentist and the patient.</li>
                            </ul>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
