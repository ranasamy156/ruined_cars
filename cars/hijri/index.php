<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <title>
       src/Bootstrap Hijri Date Picker
    </title>

    
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />


</head>
<body class="bg-light">
<?php
include "Hijri_GregorianConvert.php";
include "../hijri.php";
$DateConv=new Hijri_GregorianConvert;

?>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Bootstrap Hijri Date Picker v1.0.0</h2>
            <p class="lead">

            </p>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Date
                        </label>
                        <div class="input-group">
                            <input type="text" name="date" class="form-control hijri-date-input" />
                            <button name="save" class="form-control">save</button>
                            <?php
                                if(isset($_POST['save'])){
                                    $date=$_POST['date'];
                                    $ex = explode("-", $date);
                                    echo $ex[0]."</br>".$ex[1]."</br>".$ex[2];
                                    if($ex[0] <= 1900){
                                        $format="YYYY-MM-DD";
                                        $result=$DateConv->HijriToGregorian($date,$format);
                                        echo "</br>Hijri to Gregorian Result: ".$result."<br>";
                                    }elseif($ex[0] > 1900){
                                        echo "</br>Hijri to Gregorian Result: ".$date."<br>";
                                    }
                                    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/momentjs.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/moment-hijri.js"></script>
    <script src="js/bootstrap-hijri-datetimepicker.js"></script>

    <script type="text/javascript">


        $(function () {

            initHijrDatePicker();

            //initHijrDatePickerDefault();

            $('.disable-date').hijriDatePicker({

                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });

        });

        function initHijrDatePicker() {

            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "YYYY-MM-DD",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {

            $(".hijri-date-input").hijriDatePicker();
        }


    </script>

</body>
</html>