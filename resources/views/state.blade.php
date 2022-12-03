@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4 mt-20">
        <div class="container-fluid">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="drive-wrap">
                        <h4>Locations</h4>
                        <ul class="drive-list-wrap">
                            @foreach($state as $st)
                            <li class="mb-1">
                                <a href="/">
                                    <img src="assets/images/icon/folder-2.svg" alt="folder-2">
                                    {{$st->name}} State
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <div class="my-file-area">
                    <div class="quick-access">
                        <h3>LGAs</h3>
                        <div class="row">
                            @foreach($st->lga as $lga)
                            <div class="col-xxl-3 col-sm-4">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/file.svg" alt="file">
                                    </div>
                                    <h6>{{ $lga->name }}</h6>
                                    <span>{{ $lga->ward->count() }} Wards</span>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/file.svg" alt="file">
                                    </div>
                                    <h6>Project Work</h6>
                                    <span>05 Files</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/word.svg" alt="file">
                                    </div>
                                    <h6>Presentation</h6>
                                    <span>05 Files</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/pdf.svg" alt="file">
                                    </div>
                                    <h6>Pdf Files</h6>
                                    <span>05 Files</span>
                                </div>
                            </div>
                        </div>

                        <h3>My Devices</h3>

                        <div class="row">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/file.svg" alt="file">
                                    </div>
                                    <h6>Proposal</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/open-file.svg" alt="file">
                                    </div>
                                    <h6>Project Work</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/doc.svg" alt="file">
                                    </div>
                                    <h6>Writing File</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/pdf.svg" alt="file">
                                    </div>
                                    <h6>Pdf Files</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/excel.svg" alt="file">
                                    </div>
                                    <h6>Management Sheet</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/open-file.svg" alt="file">
                                    </div>
                                    <h6>Project Work</h6>
                                    <span>05 Files</span>
                                    <span class="mb">2.5 MB</span>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="single-folder">
                                    <div class="dropdown text-end">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/icon/dots.svg" alt="dots">
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-save"></i> Save File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-trash"></i> Delete File
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bx bx-hdd"></i> Save To Drive
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center file">
                                        <img src="assets/images/file/open-file.svg" alt="file">
                                    </div>
                                    <h6>Personal Folder</h6>
                                    <span>05 Files</span>
                                    <span class="mb">0.3 MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
