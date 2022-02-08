@extends('layouts.app-basic', ['title' => 'Citra Courses'])
@section('content')
    @if ($data = Session::get('data'))
        <div class="alert alert-{{ $data['type'] ?? 'error' }} alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ $data['message'] ?? 'SERVER ERROR' }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="form-group">
                    <label>Search:</label>
                    <form method="GET" action="{{ route('citras.index') }}">
                        <div class="input-group">
                            <input id="inputSearch" name="search" type="text" class="form-control"
                                   value="{{ Request::input('search') }}" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </form>
                </div>
                <hr/>

                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('citras.index', ['category' => 'C1']) }}" class="list-group-item">C1: Etika,
                            Kewarganegaraan & Ketamadunan<span
                                class="float-right badge badge-light round">{{ $citraCategory['C1']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citras.index', ['category' => 'C2']) }}" class="list-group-item">C2: Bahasa,
                            Komunikasi & Literasi<span
                                class="float-right badge badge-light round">{{ $citraCategory['C2']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citras.index', ['category' => 'C3']) }}" class="list-group-item">C3:
                            Kuantitatif & Kualitatif<span
                                class="float-right badge badge-light round">{{ $citraCategory['C3']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citras.index', ['category' => 'C4']) }}" class="list-group-item">C4:
                            Kepimpinan, Keusahawanan & Inovasi<span
                                class="float-right badge badge-light round">{{ $citraCategory['C4']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citras.index', ['category' => 'C5']) }}" class="list-group-item">C5: Sains,
                            Teknologi dan Kelestarian<span
                                class="float-right badge badge-light round">{{ $citraCategory['C5']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citras.index', ['category' => 'C6']) }}" class="list-group-item">C6:
                            Kekeluargaan, Kesihatan dan Gaya Hidup<span
                                class="float-right badge badge-light round">{{ $citraCategory['C6']->cnt ?? 0 }}</span>
                        </a>
                    </div>
                </div>

                @if(Request::collect()->count() > 0)
                    <a href="{{ route('citras.index') }}">Reset</a>
                @endif
            </div>
        </div>

        <div class="col-md-9">

            @if(Request::input('category'))
                <div class="card card-info card-outline collapsed-card">
                    <div class="card-header">
                        @switch(Request::input('category'))
                            @case('C1')
                            <h3 class="card-title">Citra 1 - Etika, kewarganegaraan & ketamadunan</h3>
                            @break

                            @case('C2')
                            <h3 class="card-title">Citra 2 – Citra Bahasa, Komunikasi & Literasi</h3>
                            @break

                            @case('C3')
                            <h3 class="card-title">Citra 3 - Citra Kuantitatif & Kualitatif</h3>
                            @break

                            @case('C4')
                            <h3 class="card-title">Citra 4 - Citra Kepimpinan, Keusahawanan & Inovasi</h3>
                            @break

                            @case('C5')
                            <h3 class="card-title">Citra 5 - Citra Sains, Teknologi dan Kelestarian</h3>
                            @break

                            @case('C6')
                            <h3 class="card-title">Citra 6 - Kekeluargaan, Kesihatan dan Gaya Hidup</h3>
                            @break
                        @endswitch

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><strong></strong></h5>

                        <p class="card-text text-justify">
                            @switch(Request::input('category'))
                                @case('C1')

                                Etika, kewarganegaraan & ketamadunan merupakan elemen penting dalam pembinaan diri serta
                                profesionalisme pelajar, yang meliputi aspek jasmani (fizikal), aspek rohani, naluri,
                                sosial
                                dan akal (kognitif). Kemajuan tamadun dunia juga bertitik tolak daripada sikap toleransi
                                yang tinggi, hormat-menghormati, mempunyai interaksi budaya dan hubungan sosial yang
                                aktif.
                                Citra ini bermatlamat mengenali asal-usul dan asas bagi setiap agama atau kepercayaan.
                                Melalui Citra ini pelajar dapat menonjolkan sikap yang bertanggungjawab kepada diri,
                                keluarga, masyarakat dan negara dengan menyumbang idea atau melibatkan diri dalam
                                aktiviti
                                yang dianjurkan oleh masyarakat dan negara. Citra ini juga memberi kesedaran tentang
                                peranan, hak dan tanggungjawab dalam masyarakat dan negara. Ini bertujuan untuk
                                melahirkan
                                anggota masyarakat dan warganegara yang bersatu padu, patriotik, menjunjung keluhuran
                                perlembagaan dan boleh menyumbang ke arah kesejahteraan masyarakat, negara dan dunia.
                                Citra
                                Etika, kewarganegaraan & ketamadunan mencakupi kursus-kursus berkaitan dengan etika,
                                etika
                                gunaan, falsafah, perlembagaan, alam dan manusia, nilai akhlak, moral, keterampilan,
                                wibawadiri, karisma, kualiti, tingkah laku individu, adab, kesopanan dan personaliti.
                                Citra
                                ini bermatlamat untuk melahirkan pelajar yang mempunyai etika, bertamadun, patriotik,
                                pegangan nilai murni dan bersahsiah tinggi dalam kehidupannya.
                                @break

                                @case('C2')
                                Antara matlamat utama pendidikan UKM ialah menghasilkan graduan yang cekap dalam
                                pelbagai bahasa khususnya Bahasa Melayu sebagai bahasa kebangsaan dan Bahasa Inggeris
                                sebagai bahasa kedua. Citra Bahasa, Komunikasi dan Literasi merangkumi penguasaan Bahasa
                                Melayu dan Bahasa Inggeris di samping menguasai bahasa ketiga yang relevan, iaitu bahasa
                                tempatan seperti Mandarin dan Tamil serta bahasa asing seperti Arab, Jepun dan
                                sebagainya. Citra ini melibatkan pelbagai modality iaitu kemahiran, kepenggunaan dan
                                kesesuaian bahasa. Penguasaan dan kemahiran bahasa yang bersifat multilingual dan
                                bilingual merupakan keperluan utama disamping penguasaan bahasa ketiga yang dijadikan
                                satu aspirasi. Ia juga merangkumi penggunaan bahasa yang relevan secara intra dan inter
                                disiplin, sebagai contoh “Laras bahasa saintifik”. Matlamat Citra Bahasa, Komunikasi dan
                                Literasi ialah pencitraan graduan UKM yang mempunyai keyakinan dan keterampilan bahasa
                                untuk berkomunikasi dengan berkesan dan kritis. Keterampilan ini meliputi keyakinan
                                serta keupayaan berkomunikasi dengan efektif dalam bentuk lisan dan penulisan. Citra ini
                                bertujuan menghasilkan graduan yang dapat menyampaikan maklumat, menilai, menerima dan
                                memberi hujahan dan pendapat dalam disiplin ilmu masing-masing secara bersahaja
                                (effortless). Ia juga bertujuan untuk meningkatkan kemahiran berkomunikasi pelajar
                                secara lisan, penulisan secara berhemah dalam pelbagai konteks; dalam konteks
                                persekitaran masa kini, lingkungan komersial dan kepelbagaian budaya. Citra ini juga
                                bermatlamat untuk menghasilkan graduan yang mempunyai tahap literasi yang tinggi yang
                                boleh memahami dan mengupas maklumat dalam pelbagai konteks atau genre serta mempunyai
                                kebolehan menilai, menganalisis, mengsintesis dan menilai maklumat tersebut.
                                @break

                                @case('C3')
                                Salah satu fokus kepada falsafah pendidikan Malaysia ialah untuk memperkembang lagi
                                potensi individu secara menyeluruh dan bersepadu untuk mewujudkan insan yang seimbang
                                dan harmonis dari segi intelek. Untuk melahirkan graduan yang berminda intelek,
                                keupayaan untuk membuat penaakulan telah dikenalpasti sebagai satu ciri penting. Membuat
                                penaakulan bermaksud membuat pertimbangan berdasarkan fakta dan konteks sesuatu situasi.
                                Fakta diperoleh menerusi data yang didapati melalui kaedah penyiasatan samada kualitatif
                                atau kuantitatif, atau menggunakan teknik dalam matematik dan statistik, manakala
                                konteks pula merangkumi aspek ekosistem yang terlibat dalam sesuatu situasi seperti
                                sistem nilai dan kepercayaan, andaian, emosi, personaliti dan sebagainya. Citra ini
                                merangkumi pengetahuan yang berkaitan dengan kaedah penyelidikan, matematik dan
                                statistik, pemikiran kritis dan pembuatan keputusan. Matlamat Citra ini ialah untuk
                                memberi panduan kepada pelajar membuat penaakulan menggunakan bukti secara empirik
                                (kualitatif dan kuantitatif) dengan menggunakan prinsip penyelidikan saintifik,
                                matematik, statistik dan prinsip pembuatan keputusan berlandaskan kepada aspek-aspek
                                kontekstual dalam sesuatu masyarakat. Apa yang dimaksudkan kontekstual ialah dengan
                                mengambilkira aspek-aspek penting seperti sistem nilai dan kepercayaan, andaian, kawalan
                                keatas keputusan, dan falsafah penubuhan organisasi.
                                @break

                                @case('C4')
                                Keperluan kepimpinan, keusahawanan dan inovasi adalah tunjang kepada pembangunan insan
                                yang berdaya menggerakkan diri, keluarga dan masyarakatnya. Justeru, suatu kerangka
                                pendidikan yang berpaksikan kepada pendekatan duniawi dan ukhrawi wajar dilaksana.
                                Melalui pendidikan domain ini, pelajar dapat menjadi pemimpin yang mempunyai sifat-sifat
                                kreatif dan inovatif serta akhirnya Berjaya menjadi penyumbang aktif kepada pembangunan
                                negara. Hasrat domain ini ialah untuk menjana insan yang peka kepada amalan-amalan ihsan
                                dan sejajar pula dengan pembutiran Falsafah Universiti. Atas rasional tersebut maka
                                domain yang memberi focus terhadap ilmu, kemahiran kepimpinan, keusahawanan dan inovasi
                                amatlah penting. Matlamat kursus dalam domain ini adalah untuk membentuk dan melahirkan
                                pelajar yang memiliki sifat seorang pemimpin, memiliki minda keusahawanan dan sentiasa
                                berkebolehan dalam berinovasi. Untuk itu, pengetahuan dan kemahiran kepimpinan,
                                keusahawanan serta berinovasi perlu diterapkan dalam kursus-kursus universiti bagi
                                melahirkan individu yang mampu memimpin komuniti, organisasi di peringkat kebangsaan dan
                                antarabangsa secara berkesan. Domain ini juga perlu merangkumi semua dimensi kognitif,
                                afektif dan psikomotor. Dimensi kognitif merangkumi kursus-kursus yang memperihalkan
                                teori, konsep, model,sifat, amalan dan isu-isu dalam domain. Dimensi afektif pula
                                termasuk kursus-kursus berkaitan dengan kemahiran berkomunikasi, menaakul (reasoning),
                                merancang, menyelesaikan masalah, membuat keputusan, kerjasama berpasukan dan
                                sebagainya. Sementara, dimensi psikomotor pula melibatkan kursus-kursus yang memerlukan
                                pelajar mengaplikasi serta mempamerkan keupayaan kognitif dan afektif mengikut konteks.
                                @break

                                @case('C5')
                                Kemajuan Sains dan Teknologi member kesan yang besar terhadap kelestarian alam sekitar
                                dan masyarakat. Individu yang berpengetahuan dan peka seharusnya mengambil berat tentang
                                perkara tersebut Memandangkan pembangunan teknologi diperlukan untuk pembangunan negara,
                                adalah sangat penting bagi pelajar dan pengajar mensepadukan ilmu sains dan teknologi
                                dengan sains social dalam membincangkan isu berkaitan teknologi dan kesannya terhadap
                                kelestarian persekitaran dan masyarakat. Citra Sains, Teknologi dan Kelestarian
                                mengambilkira penawaran kusus yang memfokuskan kepada falsafah, etika dan aspek social
                                teknologi terhadap alam sekitar dan masyarakat. Kandungan kursus merangkumi bagaimana
                                masyarakat membentuk, mengaplikasi dan bertindakbalas terhadap teknologi. Kadar
                                perkembangan teknologi yang pesat memerlukan pertimbangan yang teliti dan bermakna
                                kearah teknologi yang mencerminkan perkongsian nilai masyarakat dan persekitaran. Kursus
                                dalam Citra ini mendedahkan pelajar mengenai perspektif yang holistic terhadap penerapan
                                dan penggunaan teknologi. Secara keseluruhannya, kursus ini mengambilkira isu sains dan
                                teknologi dalam kehidupan manusia dan kelestarian persekitaran.
                                @break

                                @case('C6')
                                Kekeluargaan, kesihatan dan gaya hidup berkait rapat dengan keseimbangan diri individu
                                untuk menggunakan potensinya secara optimal dalam kehidupan seharian. Keseimbangan diri
                                merangkumi segala pemikiran, perasaan, sikap dan kelakuan seseorang untuk menyumbang
                                kepada masyarakat. Individu haruslah sihat daripada aspek fizikal, minda, sosial dan
                                kerohanian. Kesihatan individu berpunca daripada keluarga yang sihat. Perbincangan
                                tentang kekeluargaan merangkumi pelbagai takrifan keluarga, danhubungan asas dan
                                intergenerasi seperti suami isteri, ibubapa, anak, adik beradik dan kejiranan.
                                Pendidikan awal dalam keluarga membentuk sahsiah diri, kelakuan dan gaya hidup yang
                                sihat. Dinamika keluarga sejahtera bermakna wujudnya sokongan kepuasan, kebahagiaan dan
                                kecemerlangan hidup individu dan masyarakat. Citra ini memberi pengetahuan, pendedahan
                                dan kemahiran praktikal secara holistik kepada pelajar tentang kekeluargaan, kesihatan
                                dan gaya hidup sihat.
                                @break
                            @endswitch
                        </p>
                    </div>
                </div>
        @endif

        <!-- Default data table -->
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">Citra Courses</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 12%">Course Code</th>
                                <th>Course Name</th>
                                <th>Course Credit</th>
                                <th>Course Category</th>
                                <th style="width:10%">Registered</th>
                                <th style="width: 25%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{ count($citras) < 1 ? 'No data to be displayed.' : '' }}
                            @foreach ($citras as $citra)
                                <tr>
                                    <td class="align-middle">{{ $citra->courseCode }}</td>
                                    <td class="align-middle">{{ $citra->courseName }}</td>
                                    <td class="align-middle">{{ $citra->courseCredit }}</td>
                                    <td class="align-middle">{{ $citra->courseCategory }}</td>
                                    <td class="align-middle text-center">{{ $citra->application->where('status', 'approved')->count() }}
                                        /{{ $citra->courseAvailability }}</td>
                                    <td class="align-middle" class="text-center">
                                        <a href="{{ route('citras.show', $citra->courseCode) }}"
                                           class="btn btn-sm bg-gradient-primary">Detail</a>

                                        @if($citra->application->contains('matric_no', auth()->user()->matric_no))
                                            <a href="{{ route('myApplication.show', $citra->application->where('matric_no', auth()->user()->matric_no)->first()->application_id) }}"
                                               target="_blank" class="btn btn-sm bg-gradient-info">View Application</a>
                                        @elseif($citra->courseAvailability !== 0)
                                        <!-- data-register="{{ $citra->isAvailable() ? 1 : 0 }}" -->
                                            <button type="button" data-toggle="modal" data-target="#modal-register"
                                                    data-register="0"
                                                    data-course="{{ base64_encode(collect($citra)->except(['application', 'descriptions', 'created_at', 'updated_at'])->toJson()) }}"
                                                    class="btn btn-sm bg-gradient-success">Register
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br/>
                </div>

                @if($citras->hasPages())
                    <div class="card-footer clearfix">
                        {!! $citras->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modal-register" data-backdrop="static" data-keyboard="false" tabindex="-1" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Citra Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="form-register" action="{{ route('myApplication.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="courseCode"/>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Student Name') }}</label>
                            <input type="text" class="form-control-plaintext" value="{{ auth()->user()->name }}"
                                   readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Faculty') }}</label>
                            <input type="text" class="form-control-plaintext"
                                   value="{{ auth()->user()->studentInfo->faculty }}" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">Course Name</label>
                            <input type="text" class="form-control-plaintext" id="inputCourseName" readonly/>
                        </div>

                        <div class="form-row">
                            <div class="col-6">
                                <label for="inputCourseName">Course Category</label>
                                <input type="text" class="form-control-plaintext" id="inputCourseCategory" readonly/>
                            </div>

                            <div class="col-6">
                                <label for="inputCourseName">Course Credit</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-plaintext" id="inputCourseCredit" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">/</span>
                                        <span
                                            class="input-group-text">{{ auth()->user()->studentInfo->credit_limit }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-input-reason d-none">
                            <label for="inputReason">Reason</label>
                            <textarea class="form-control" id="inputReason" name="reason" style="resize: none"
                                      rows="3" onkeyup="countChar(this)" minlength="10" required></textarea>
                            <small class="form-text text-muted float-right"><span id="reasonCharCounter">0</span>/128</small>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="event.preventDefault();document.getElementById('form-register').submit();"
                            type="button" class="btn btn-success">Confirm
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal-register').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget) // Button that triggered the modal
                const available = button.data('register');
                const courseInfoData = button.data('course') // Extract info from data-* attributes
                const courseInfo = $.parseJSON(atob(courseInfoData));

                const modal = $(this)

                if (available === 0) {
                    modal.find('.modal-body .form-input-reason').removeClass('d-none');
                }

                modal.find('.modal-title').text(`Register ${courseInfo.courseCode} ${courseInfo.courseName}`)
                modal.find('.modal-body input#inputCourseName').val(`${courseInfo.courseCode} ${courseInfo.courseName}`)
                modal.find('.modal-body input#inputCourseCategory').val(courseInfo.courseCategory)
                modal.find('.modal-body input#inputCourseCredit').val(`${courseInfo.courseCredit}`)
                modal.find('.modal-body input[name=courseCode]').val(courseInfo.courseCode)
                modal.find('.modal-body textarea#inputReason').val('')
                modal.find('.modal-body #reasonCharCounter').text('0')
            });

            $("#modal-register").on('hidden.bs.modal', function (event) {
                const modal = $(this)

                modal.find('.modal-body .form-input-reason').addClass('d-none');
            });
        });

        function countChar(val) {
            let len = val.value.length;

            $('.modal-body #reasonCharCounter').text(len);
        };
    </script>
@endpush
