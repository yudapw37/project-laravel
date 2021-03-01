

        window.onscroll = function() {myFunction()};



            function myFunction() {

                if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {

                    var ver = document.getElementById("verHide")

                    $("#hdrBtm").fadeOut(100);

                    $("#verHide").fadeOut(100);

                } else {

                    $("#hdrBtm").fadeIn(500);

                    $("#verHide").fadeIn(800);

                }

            }

            function catVer() {

                // $("#verHide").fadeToggle();

                console.log(1);

            }

            $(document).ready(function(){

                $("catVer").click(function(){

                    console.log(2);

                    // $("#verHide").fadeToggle();

                });

            });



            var baseUrlApi = "http://storeaqwam.cemaraitsalatiga.com/";



            // window.onload = function () { onLoadMyApi() };



            function onLoad(pathhf, pathcs) {

                console.log(pathhf);

                console.log(pathcs);

                           

                axios.get(baseUrlApi + pathhf)

                    .then(response => {

                    // loopSetDataHeaderFooter(response.data);

                    })

                    .catch(error => {

                    console.error(error)

                    })



                axios.get(baseUrlApi + pathcs)

                    .then(response => {

                    loopSetCategories(response.data);

                    console.log(baseUrlApi);

                    console.log(pathcs);

                    console.log(response.data);

                    })

                    .catch(error => {

                    console.error(error)

                    })

            }



            
            function loopSetCategories(variable) {

                var cat = ""

                var allcat = ""

                for (i in variable) {

                     if (i<7){

                         cat += "<li class='vertical-item level1 mega-parent' id='categorieschild'><a href='/katalog/" + variable[i].id_kategori+"'>"+ variable[i].nama_kategori+"</a></li>";

                     }                                      

                }



                if (variable.length>7){

                    cat += "<li class='vertical-item level1 vertical-drop mega-parent'><a href=''>All categlories</a> <div class='menu-level-1 dropdown-menu vertical-menu'> <ul class='vertical-menu1' id='allcat'>  </ul> </div> </li>";

                    for (j in variable) {

                        if (j>6){

                            allcat += "<li ><a href='/katalog/" + variable[i].id_kategori+"'>"+ variable[j].nama_kategori+"</a></li>";

                        }                                      

                    }

                }



                

                // <li ><a href='#'>Buku</a></li>

                // console.log(variable.length);

                document.getElementById("categories").innerHTML = cat;

                document.getElementById("allcat").innerHTML = allcat;

                // console.log(variable);

            }

            var x = 0;

            var getCategoriesCek;

             function catVerShow() {

                 var mod = x % 2;

                 if (mod==1){

                     $("#verHide").fadeOut(100);

                 }

                 else{

                    $("#verHide").fadeIn(100);



                    if(getCategoriesCek==null){

                        axios.get(baseUrlApi + 'api/categories')

                        .then(response => {

                        getCategoriesCek= response.data;

                        loopSetCategories(response.data);

                        console.log(baseUrlApi);

                        // console.log(pathcs);

                        console.log(response.data);

                        })

                        .catch(error => {

                        console.error(error)

                        })

                    }

                 }

                 x += 1;

                    // console.log(x);

             }