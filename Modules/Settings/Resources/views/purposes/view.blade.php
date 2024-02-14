<div class="modal fade" id="ViewModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">KYC Initiate
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">

                <div class=" bgc-model m-2">
                    <div class="row ">
                        <div class="col-md-6 col-sm-6  ">
                            <p  class="text-color">Purpose
                            </p>
                            <div>
                                <p>{{$data['purpose_name']}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                            <p  class="text-color">Purpose Code</p>
                            <div>
                                <p>{{$data['purpose_code']}}</p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class=" bgc-model m-2">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 ">
                            <p  class="text-color">TCS Rate %
                            </p>
                            <div>
                                <p>{{$data['tcs']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" bgc-model m-2">
                    <div class="row ">
                        <div class=" ">
                            <p  class="text-color">Required Documents
                            </p>
                        </div>
                    </div>
                </div>

                @foreach($dataDocuments as $val)
                    <div class=" bgc-model m-2">
                        <li class=" list-unstyled m-2 ">
                            <label for="documents-{{$val['id']}}" class="m-0">{{$val['document_name']}}</label>
                            <input type="checkbox" class="float-end mt-1" name="documents[]" id="documents-{{$val['id']}}" value="{{$val['id']}}" {{str_contains($data['documents'], $val['id']) ? "checked":""}}>
                        </li>
                    </div>
                @endforeach



            </div>
            {{--<div class="d-flex justify-content-center gap-3">
                <div class="text-center pt-3 pb-3">
                    <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Back</button></a>
                </div>
                <div class="text-center pt-3 pb-3">
                    <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Confirm
                        </button></a>
                </div>
            </div>--}}

        </div>
    </div>
</div>
<script>
    $(".btn-close").click(function(){
        $('.modal').modal('hide');
    });
</script>

