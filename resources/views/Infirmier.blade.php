<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


@include('components.navbar')
<x-header>Profile</x-header>

<style>
    .secondcol {
        margin-top: 30px
    }

    .row3 {
        width: 100%;
    }
</style>

<div class="row">
    <div class="secondcol col-lg bg-light p-0 d-flex justify-center align-items-center">

        <div class="container-lg">
            <div class="col-lg border-right row3">
                <div class="p-2 py-3">
                    <div class="row mt-2 mrg">
                        <div class="col-md-6">
                            <label class="labels">Nom</label>
                            <input type="text" class="form-control" placeholder="Nom" value="" readonly />
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Prenom</label>
                            <input type="text" class="form-control" placeholder="Prenom" value="" readonly />
                        </div>
                    </div>
                    <div class="row mt-2 mrg">
                        <div class="col-md-6">
                            <label class="labels">CIN</label>
                            <input type="text" class="form-control" placeholder="First Name" value=""
                                readonly />
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Telephone</label>
                            <input type="text" class="form-control" placeholder="numero de Telephone" value=""
                                readonly />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mrg">
                            <label class="labels">Adresse</label>
                            <input type="text" class="form-control" placeholder="Address " value="" readonly />
                        </div>
                    </div>
                    <div class="row mt-3 mrg">
                        <div class="col-md-6">
                            <label class="labels">Country</label>
                            <input type="text" class="form-control" placeholder="Country" value="" readonly />
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Region</label>
                            <input type="text" class="form-control" placeholder="State/Region" value=""
                                readonly />
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-outline-light profile-button" type="button">
                            Edit profile
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
