<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Users
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <span class="text-muted fs-6 fw-bold px-2"> IT Professionals</span></h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xxl-325px mb-8 mb-lg-0 me-lg-9 me-5">
                    <form action="#">
                        <div class="card">
                            <div class="card-body">
                                <div class="position-relative">
                                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Search" />
                                    <!-- <input  style="width: 20em; border-right: none;" type="text"  class="form-control border-secondary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Search"/> -->
                                </div>
                                <div class="separator separator-dashed my-8"></div>
                                <div style="height: 65vh;">
                                    <!-- <label class="fs-3 form-label fw-bolder text-dark">Advance Search</label> -->
                                </div>    
                                <!-- <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Team Type</label>
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="In Progress" data-hide-search="true">
                                        <option value=""></option>
                                        <option value="1">Not Started</option>
                                        <option value="2" selected="selected">In Progress</option>
                                        <option value="3">Done</option>
                                    </select>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Team Name</label>
                                    <input type="text" class="form-control form-control form-control-solid" name="city" />
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Team Size</label>
                                    <div class="nav-group nav-group-fluid">
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="has" checked="checked" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">1-5</span>
                                        </label>
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="users" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">5-10</span>
                                        </label>
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="orders" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">10++</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label class="fs-6 form-label fw-bolder text-dark mb-5">Categories</label>
                                    <div class="form-check form-check-custom form-check-solid mb-5">
                                        <input class="form-check-input" type="checkbox" id="kt_search_category_1" />
                                        <label class="form-check-label flex-grow-1 fw-bold text-gray-700 fs-6" for="kt_search_category_1">Electronics</label>
                                        <span class="text-gray-400 fw-bolder">28</span>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid mb-5">
                                        <input class="form-check-input" type="checkbox" id="kt_search_category_2" checked="checked" />
                                        <label class="form-check-label flex-grow-1 fw-bold text-gray-700 fs-6" for="kt_search_category_2">Sport Equipments</label>
                                        <span class="text-gray-400 fw-bolder">307</span>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" id="kt_search_category_3" />
                                        <label class="form-check-label flex-grow-1 fw-bold text-gray-700 fs-6" for="kt_search_category_3">Furnuture</label>
                                        <span class="text-gray-400 fw-bolder">54</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <a href="#" class="btn btn-active-light-primary btn-color-gray-400 me-3">Discard</a>
                                    <a href="#" class="btn btn-primary">Search</a>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex-lg-row-fluid">
                    <div id="searchResults">
                    </div>
                    <div class="tab-content" id="defaultView">
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                            <div class="row g-6 g-xl-9">
                            <?php if (!empty($itpersonels)): 
                                $itemsPerPage = 10; 
                                $totalItems = count($itpersonels);
                                $totalPages = max(1, ceil($totalItems / $itemsPerPage));
                                $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $startIndex = ($currentPage - 1) * $itemsPerPage;
                                $endIndex = min($startIndex + $itemsPerPage, $totalItems);

                                for ($i = $startIndex; $i < $endIndex; $i++): 
                                    $it = $itpersonels[$i];
                                    ?>
                                    <div class="col-md-12 col-xl-12">
                                        <a href="<?=base_url()?>admin/profile=<?=$it['name']?>/<?=$it['id']?>" class="card shadow-sm border-hover-primary">
                                            <div class="card-header border-0 pt-9">
                                                <div class="card-title m-0">
                                                    <?php if(empty($it['profile_avatar'])):?>
                                                    <div class="symbol symbol-70px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-custom-class="tooltip-dark">
                                                        <span class="symbol-label symbol-circle bg-warning text-inverse-warning fw-bolder"><?= substr($it['name'] ,0,1)?></span>
                                                    </div>
                                                    <?php else:?>
                                                    <div class="symbol symbol-circle symbol-100px w-100px bg-light">
                                                        <img src="<?= base_url()?>uploads/files/<?=$it['name']?>/<?=$it['profile_avatar']?>" alt="profile image" class="p-3 symbol-circle "/>
                                                    </div>
                                                    <?php endif?>
                                                </div>
                                                <div class="card-toolbar">
                                                    <?php echo $is_verified = ($it['is_verified'] == 'Yes') ? '<i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-patch-check fs-1 text-success"></i>' 
                                                    : '';?>
                                                
                                                </div>
                                            </div>
                                            <div class="card-body p-9">
                                                <div class="fs-3 fw-bolder text-primary"><?=$it['name']?> <span class="px-2" data-bs-toggle="tooltip" title="Gold Tier" data-bs-custom-class="tooltip-dark"><i class="bi bi-award fs-1 text-warning"></i></span></div>
                                                <div class="fw-bolder text-dark fs-5"><?=$it['user_position']?></div>
                                                <div class="badge badge-light-success fw-bolder fs-6 mb-6 mt-2">$<?= $it['desired_rate']?>/hour</div>
                                               
                                                <div class="d-flex flex-wrap mb-5">
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px mt-1 py-3 px-4 me-7 mb-3">
                                                        <div class="fs-6 text-gray-800 fw-bolder">Profile Description</div>
                                                        <div class="fw-bold text-gray-400"><?php echo $intro = (!empty($it['introduction'])) ? $it['introduction'] : 'Not Specified';?></div>
                                                    </div>
                                                </div>
                                                 <!-- <div class="d-flex flex-wrap mb-5">
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px mt-1 py-3 px-4 me-7 mb-3">
                                                        <div class="fs-6 text-gray-800 fw-bolder mb-2">Skills</div>
                                                        <div class="custom-container">
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        <span class="custom-content bg-light fw-bolder rounded">$<?= $it['desired_rate']?>/hour</span>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </a>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                            </div>
                            <div class="d-flex flex-stack flex-wrap pt-10">
                                <div class="fs-6 fw-bold text-gray-700">
                                    <?php if ($totalItems > 0): ?>
                                        Showing <?= $startIndex + 1 ?> to <?= $endIndex ?> of <?= $totalItems ?> entries
                                    <?php else: ?>
                                        No entries available
                                    <?php endif; ?>
                                </div>
                                <ul class="pagination">
                                    <li class="page-item previous">
                                        <a href="#" class="page-link">
                                            <i class="previous"></i>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php if ($i === $currentPage) echo 'active'; ?>">
                                            <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item next">
                                        <a href="#" class="page-link">
                                            <i class="next"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                function toolTips(){
                    $('[data-bs-toggle="tooltip"]').tooltip()
                }
                var keyword = $(this).val();
                if (keyword !== '') {
                    $('#defaultView').addClass('d-none');
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url()?>admin/search-personel',
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
                                    var verifiedHtml = '';
                                    var positionHtml = '';
                                    var positionHtml = '';

                                    if (result.profile_avatar === '') {
                                        avatarHtml = '<div class="symbol symbol-70px symbol-circle" data-bs-toggle="tooltip" title="' + result.name + '" data-bs-custom-class="tooltip-dark">\
                                                        <span class="symbol-label symbol-circle bg-warning text-inverse-warning fw-bolder">' + firstLetter + '</span>\
                                                    </div>';
                                    } else {
                                        avatarHtml = '<div class="symbol symbol-circle symbol-100px w-100px bg-light">\
                                                        <img src="/uploads/files/' + result.name + '/' + result.profile_avatar + '" alt="profile image" class="p-3 symbol-circle "/>\
                                                    </div>';
                                    }
                                    if (result.is_verified === 'Yes') {
                                        verifiedHtml = '<i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-patch-check fs-1 text-success"></i>';
                                    } else {
                                        verifiedHtml = '';
                                    }
                                    if (result.is_verified === 'Yes') {
                                        positionHtml = '<div class="fw-bold text-gray-400">'+result.introduction+'</div>';
                                    } else {
                                        positionHtml = 'Not Specified';
                                    }

                                    resultsHtml += '<div class="col-md-12 col-xl-12">\
                                        <a href="/admin/profile=' + result.name + '/' + result.id + '" class="card shadow-sm border-hover-primary">\
                                            <div class="card-header border-0 pt-9">\
                                                <div class="card-title m-0">\
                                                '+avatarHtml+'\
                                                </div>\
                                                <div class="card-toolbar">\
                                                '+verifiedHtml+'\
                                                </div>\
                                            </div>\
                                            <div class="card-body p-9">\
                                                <div class="fs-3 fw-bolder text-primary">' + result.name + '<span class="px-2" data-bs-toggle="tooltip" title="Gold Tier" data-bs-custom-class="tooltip-dark"><i class="bi bi-award fs-1 text-warning"></i></span></div>\
                                                <div class="fw-bolder text-dark fs-5">' + result.user_position + '</div>\
                                                <div class="badge badge-light-success fw-bolder fs-6 mb-6 mt-2">$' + result.desired_rate + '/hour</div>\
                                               \
                                                <div class="d-flex flex-wrap mb-5">\
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px mt-1 py-3 px-4 me-7 mb-3">\
                                                        <div class="fs-6 text-gray-800 fw-bolder">Profile Description</div>\
                                                        '+positionHtml+'\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </a>\
                                    </div>'
                                });
                                resultsHtml += '</div>';
                                toolTips()
   
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


