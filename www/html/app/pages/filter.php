<div id="filter" class="mb-2">
    <div class="row">
        <div class='col-xl-2 col-lg-12'>
            <label for="filterItem" class="form-label">Item:</label>
            <select id="filterItem" class='item-select2 form-control' type="text"></select> 
        </div>
        <div class='col-xl-2 col-lg-12'>
            <label for="filterItemType" class="form-label">Category:</label>
            <select id="filterItemType" class='item-type-select2 form-control' type="text"></select> 
        </div>
        <div class='col-xl-3 col-lg-12'>
            <label for="filterStore" class="form-label">Store:</label>
            <select id="filterStore" class='store-select2 form-control' type="text"></select>
        </div>
        <div class='col-xl-3 col-lg-12'>
            <label for="amount">Price range:</label>
            <input type="text" id="amount" readonly style="border:0; color:#000000; font-weight:bold;">
            <div id="filterPrice" class="mt-2"></div>
        </div>
        <div class='col-xl-1 col-lg-6'>
            <button id='clearFilter' type="button" class='btn btn-sm btn-warning mt-4 px-1 form-control' title="Clear Button" aria-label="Clear Button">Clear</button>
        </div>
        <div class='col-xl-1 col-lg-6'>
            <button id='applyFilter' type="button" class='btn btn-sm btn-success mt-4 px-1 form-control' title="Apply Button" aria-label="Apply Button">Apply</button>
        </div>
    </div>
    
</div>