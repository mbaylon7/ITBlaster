<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Users</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-dark">IT Professional</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
       
        <div class="d-flex flex-wrap flex-stack pb-7">
            <div class="d-flex flex-wrap align-items-center my-1">
                <h3 class="fw-bolder me-5 my-1">Clients (<?=$counts?>)</h3>
            </div>
            
            <div class="d-flex flex-wrap my-1">
                <div class="mx-3 mt-4 px-0">
                    <a href="#" data-bs-toggle="tooltip" title="Card View" data-bs-custom-class="tooltip-dark"><i class="bi bi-grid fs-3 text-gray-700"></i></a>
                </div>
                <div class="mx-3 mt-4 px-0">
                    <a href="#" data-bs-toggle="tooltip" title="Tabled View" data-bs-custom-class="tooltip-dark"><i class="bi bi-table fs-3 text-gray-700"></i></a>
                </div>
                <div class="d-flex align-items-center position-relative mx-6 my-1">
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text"  id="searchInput" class="form-control form-control-sm border-body bg-body w-250px ps-10" placeholder="Search" />
                </div>
            </div>

            </div>
            <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                <div id="searchResults"></div>
                <div class="row g-6 g-xl-9" id="defaultView">
                    <?php if(!empty($clients)): foreach ($clients as $client):
                        $count = 0;
                        if(!empty($projects)) {
                            foreach($projects as $project) {
                                if ($project['clientid'] == $client['id']){
                                    $count++;
                                }
                            }
                        }    
                    ?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card">
                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <div class="symbol symbol-65px symbol-circle mb-5">
                                    <?php if(empty($client['profile_avatar'])): ?>
                                    <span class="symbol-label fs-2x fw-bold text-primary bg-light-primary"><?= substr($client['name'] ,0,1)?></span>
                                    <?php else:?>
                                    <img src="<?=base_url()?>uploads/files/<?=$client['name']?>/<?=$client['profile_avatar']?>" alt="image" />
                                    <?php endif?>
                                    <div class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                </div>
                                <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0 text-center"><?=$client['name']?></a>
                                <div class="fw-bold text-gray-400 mb-6"><?=$client['company']?></div>
                                <div class="d-flex flex-center flex-wrap">
                                    <?php if(!empty($service_products)): foreach($service_products as $product): if($client['userId'] == $product['prodser_clientid']):?>
                                        <a href="#" class="badge badge-light-success fw-bolder m-1" data-bs-toggle="tooltip" title="Products and Services" data-bs-custom-class="tooltip-dark"><?=$product['prodser_name']?></a>
                                    <?php endif; endforeach; endif?>
                                </div>
                                <div class="d-flex flex-center flex-wrap mt-2">
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
    									<div class="fs-6 fw-bolder text-gray-700 text-center"><?=$count?></div>
    									<div class="fw-bold text-gray-400">All Owned Projects</div>
    								</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var keyword = $(this).val();
                if (keyword !== '') {
                    $('#defaultView').addClass('d-none');
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url()?>admin/search-client',
                        data: { keyword: keyword },
                        dataType: 'json',
                        success: function(response) {
                            var results = response.results;
                            var resultsHtml = '';

                            if (results.length > 0) {
                                resultsHtml += '<div class="row g-6 g-xl-9 mt-1">';
                                $.each(results, function(index, result) {
                                    var firstLetter = result.name.charAt(0);
                                    var avatarHtml = '';
                                    var positionHtml = '';

                                    if (result.profile_avatar === '') {
                                        avatarHtml = '<span class="symbol-label fs-2x fw-bold text-primary bg-light-primary">' + firstLetter + '</span>';
                                    } else {
                                        avatarHtml = '<img src="/uploads/files/' + result.name + '/' + result.profile_avatar + '" alt="profile image" />';
                                    }

                                    resultsHtml += '<div class="col-md-6 col-xxl-4">\
                                        <div class="card">\
                                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">\
                                                <div class="symbol symbol-65px symbol-circle mb-5">\
                                                    '+avatarHtml+'\
                                                    <div class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>\
                                                </div>\
                                                <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0 text-center">' + result.name + '</a>\
                                                <div class="fw-bold text-gray-400 mb-6">' + result.company + '</div>\
                                            </div>\
                                        </div>\
                                    </div>';
                                
                                    // resultsHtml += '<li>' + result.name + ' - ' + result.user_position  + ' - ' + result.desired_rate  + ' - ' + result.contactnumber  +'</li>';
                                });
                                resultsHtml += '</div>';
   
                            } else {
                                resultsHtml = '<div class="col-md-12 col-xxl-12"> <div class="card"><div class="card-body d-flex flex-center flex-column pt-12 p-9">No results found.</div></div></div>';
                            }
                            $('#searchResults').html(resultsHtml);
                        }
                    });
                } else {
                    $('#searchResults').html('');
                    $('#defaultView').removeClass('d-none');
                }
            });
        });
    </script>
<?= $this->endsection() ?>