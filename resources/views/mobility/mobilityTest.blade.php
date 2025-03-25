@include('header')

<div class="col-xl-8 col-lg-8 content-right" id="start">
    <div id="wizard_container">

        <!-- /top-wizard -->
        <form id="wrapped" class="indexClass" method="POST" action="{{ route('mobilitySecondStore') }}">
            @csrf
            <input id="website" name="website" type="text" value="">
            <div id="middle-wizard">
              
                <div style="font-size: 18px; color: #007bff; font-weight: bold;">
                    13th
                </div>
                <div class="step">
                    <h3 class="main_question">Before We Start Need Some Basic Identifiers</h3>
                    <div class="form-group add_top_30">
                        <label for="name">Patient Name</label>
                        <input type="text" name="patientname" id="name" class="form-control required"
                            onchange="getVals(this, 'name_field');">
                    </div>
                    <div class="form-group">
                        <label for="phone">Patient Phone</label>
                        <input type="text" name="patientphone" id="phone" class="form-control required"
                            maxlength="10">
                    </div>
                    <div class="form-group add_top_30">
                        <label for="email">Email Address</label>
                        <input type="email" name="patientemail" id="email" class="form-control required">
                    </div>
                </div>
                <div class="submit step" id="end">
                    <div class="">
                        <div class="wrapper">

                        </div>
                    </div>
                </div>
                <!-- /step last-->

            </div>
            <!-- /middle-wizard -->
            <div id="bottom-wizard">
                <button type="button" name="forward" class="forward" onclick="indexsubmit(this.value)">Next</button>
            </div>
            <!-- /bottom-wizard -->


        </form>
    </div>
    <!-- /Wizard container -->
</div>


@include('footer')
