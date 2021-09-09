<div class="container-fluid bg-primary mt-5">
    <div class="row ml-1 text-light">

        <div class="col-8 mt-3">
            <h2 class="text-warning">Netciety</h2>
            <p>&copy; 2021 - &infin; | Netciety</p>
        </div>

        <div class="col text-right mt-3">
            <h4 class="text-center">Follow Us</h4>
            <div class="row d-flex justify-content-around">
                <a href="https://facebook.com" target="_blank" class="p-2 mr-3">
                    <img src="/netciety/images/fb.png" class="bg-light rounded-circle" style="width: 20px; transform: scale(2);">
                </a>
                <a href="https://instagram.com" target="_blank" class="p-2 mr-3">
                    <img src="/netciety/images/insta.png" style="width: 20px; transform: scale(2);;">
                </a>
                <a href="https://youtube.com" target="_blank" class="p-2 mr-3">
                    <img src="/netciety/images/yt.png" style="width: 20px; transform: scale(2);">
                </a>
                <a href="https://twitter.com" target="_blank" class="p-2 mr-3">
                    <img src="/netciety/images/twitter.png" style="width: 20px; transform: scale(2);">
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <p class="text-light mx-auto mt-2">Created by <strong>klemontea</strong></p>
    </div>
</div>

</div>
</div>

<script src="/netciety/js/jquery.js"></script>
<script src="/netciety/js/bootstrap.js"></script>
<script>
    $("#pop").on("click", function() {
        $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });
</script>
</body>

</html>