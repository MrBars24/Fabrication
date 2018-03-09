<div class="container-fluid mt-5">
	<div class="row">
        <div class="card col-sm-6 offset-3">
            <div class="card-body">
                <h2 class="font-weight-bold">Search Fabricator</h2>
                <!-- <form> -->
                <div class="form-group">
                    <label for="input-search" class="sr-only">Search Tree:</label>
                    <input type="input" class="form-control" id="input-search" placeholder="Type to search..." value="">
                </div>
                <div class="row">
                    <div class="col-12 demo-checkbox">
                        <h5 class="font-weight-bold">Country</h5>
                        <select class="custom-select col-12" id="inlineFormCustomSelect">
                            <option selected="">Afghanistan</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                                </div>
                    <div class="col-12 mt-4 demo-checkbox ">
                        <h5 class="font-weight-bold">Shop Detailer Type</h5>
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" class="checkbox" id="chk-ignore-case" value="false">
                            <label for="chk-ignore-case">Business</label>
                        </div>
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" class="checkbox" id="chk-exact-match" value="false">
                            <label for="chk-exact-match">Individuals</label>
                        </div>

                    </div>
                    <div class="col-12 demo-checkbox">
                        <h5 class="font-weight-bold">Industry</h5>
                        <input type="checkbox" class="checkbox" id="chk-Architectural" value="false">
                        <label for="chk-Architectural">Architectural</label>
                        <input type="checkbox" class="checkbox" id="chk-Commercial" value="false">
                        <label for="chk-Commercial">Commercial</label>
                        <input type="checkbox" class="checkbox" id="chk-Industrial" value="false">
                        <label for="chk-Industrial">Industrial</label>
                        <input type="checkbox" class="checkbox" id="chk-Mining" value="false">
                        <label for="chk-Mining">Mining</label>
                        <input type="checkbox" class="checkbox" id="chk-Oil" value="false">
                        <label for="chk-Oil">Oil & Gas</label>
                        <input type="checkbox" class="checkbox" id="chk-Residential" value="false">
                        <label for="chk-Residential">Residential</label>
                        <input type="checkbox" class="checkbox" id="chk-Other" value="false">
                        <label for="chk-Other">Other</label>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="btn-search">Search</button>
                <button type="button" class="btn btn-default" id="btn-clear-search">Clear</button>
                <!-- </form> -->
            </div>
        </div>

    </div>
</div>
