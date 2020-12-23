<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Morningstar MC8 Midi Commander</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery.multiselect.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webmidi"></script>
    <script src="js/jquery.multiselect.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MC8 Commander</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#" onclick="showBanks();">Banks</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Presets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" onclick="showPresets('AH', true)">A-H</a>
                    <a class="dropdown-item" href="#"onclick="showPresets('IP', true)">I-P</a>
                    <a class="dropdown-item" href="#" onclick="showPresets('All', true)">All</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            Auto-jump to Presets:&nbsp;<select class="form-control mr-sm-2" id="autojump_select">
                <option>Off</option>
                <option>Match Page</option>
                <option>All</option>
            </select>
        </form>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <form class="form-inline my-2 my-lg-0">
            Show OmniPort Presets:&nbsp;<select class="form-control mr-sm-2" id="omniports_select" multiple="multiple">
                <option value="1">OmniPort 1 Q-R-S</option>
                <option value="2">OmniPort 2 T-U-V</option>
                <option value="3">OmniPort 3 I-J-K</option>
                <option value="4">OmniPort 4 L-M-N</option>
            </select>
        </form>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <form class="form-inline my-2 my-lg-0">
            Midi Device:&nbsp;<select class="form-control mr-sm-2" id="midi_output">
            </select>
        </form>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <form class="form-inline my-2 my-lg-0">
            Midi Channel:&nbsp;<select class="form-control mr-sm-2" id="midi_channel">
        </select>
        </form>
    </div>
</nav>
<div style="display:block" id="banks">
    <div class="container">
        <?php
        echo "<div class=\"row\">";
            for ($i = 1; $i <= 30; $i++) {
                echo "<div class='col'>";
                echo "<center><button onclick='banksend(" . $i . ",1)' type=\"button\" class=\"btn btn-primary btn-lg\">B" . $i . " P1</button> <button type=\"button\" onclick='banksend(" . $i . ",2)' class=\"btn btn-info btn-lg\">B" . $i . " P2</button></center>";
                echo "</div>";
                if (($i % 5) == 0){
                    echo "</div>";
                    echo "<br>";
                    echo "<div class=\"row\">";
                }
            }
            echo "</div>";
        ?>
    </div>
</div>
<div style="display:none" id="presets_ah">
    <br>
    <div class="container border p-2">
        <b>Page 1 | <a href="#" onclick="showPresets('IP',true)">Page 2</a></b>
        <div class="row">
            <div class="col">
                <center><button onclick="presetsend('E')" type="button" class="btn btn-primary btn-lg">E</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('F')" type="button" class="btn btn-primary btn-lg">F</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('G')" type="button" class="btn btn-primary btn-lg">G</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('H')" type="button" class="btn btn-primary btn-lg">H</button></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <center><button onclick="presetsend('A')" type="button" class="btn btn-primary btn-lg">A</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('B')" type="button" class="btn btn-primary btn-lg">B</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('C')" type="button" class="btn btn-primary btn-lg">C</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('D')" type="button" class="btn btn-primary btn-lg">D</button></center>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="presets_ip">
    <br>
    <div class="container border p-2">
        <b><a href="#" onclick="showPresets('AH',true)">Page 1</a> | Page 2</b>
        <div class="row">
            <div class="col">
                <center><button onclick="presetsend('M')" type="button" class="btn btn-primary btn-lg">M</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('N')" type="button" class="btn btn-primary btn-lg">N</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('O')" type="button" class="btn btn-primary btn-lg">O</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('P')" type="button" class="btn btn-primary btn-lg">P</button></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <center><button onclick="presetsend('I')" type="button" class="btn btn-primary btn-lg">I</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('J')" type="button" class="btn btn-primary btn-lg">J</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('K')" type="button" class="btn btn-primary btn-lg">K</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('L')" type="button" class="btn btn-primary btn-lg">L</button></center>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="presets_op1">
    <br>
    <div class="container border p-2">
        <div class="row">
            <div class="col"><b>OmniPort 1</b></div>
            <div class="col">
                <center><button onclick="presetsend('Q')" type="button" class="btn btn-primary btn-lg">Q</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('R')" type="button" class="btn btn-primary btn-lg">R</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('S')" type="button" class="btn btn-primary btn-lg">S</button></center>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="presets_op2">
    <br>
    <div class="container border p-2">
        <div class="row">
            <div class="col"><b>OmniPort 2</b></div>
            <div class="col">
                <center><button onclick="presetsend('T')" type="button" class="btn btn-primary btn-lg">T</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('U')" type="button" class="btn btn-primary btn-lg">U</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('V')" type="button" class="btn btn-primary btn-lg">V</button></center>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="presets_op3">
    <br>
    <div class="container border p-2">
        <div class="row">
            <div class="col"><b>OmniPort 3</b></div>
            <div class="col">
                <center><button onclick="presetsend('I')" type="button" class="btn btn-primary btn-lg">I</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('J')" type="button" class="btn btn-primary btn-lg">J</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('K')" type="button" class="btn btn-primary btn-lg">K</button></center>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="presets_op4">
    <br>
    <div class="container border p-2">
        <div class="row">
            <div class="col"><b>OmniPort 4</b></div>
            <div class="col">
                <center><button onclick="presetsend('L')" type="button" class="btn btn-primary btn-lg">L</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('M')" type="button" class="btn btn-primary btn-lg">M</button></center>
            </div>
            <div class="col">
                <center><button onclick="presetsend('N')" type="button" class="btn btn-primary btn-lg">N</button></center>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    var global_page = 1;
    var global_bank = 1;
    String.prototype.getPositionInAlphabet = function() {
        var alphabet = 'abcdefghijklmnopqrstuvwxyz'.split(''),
            letter = this.length > 1 ? this.charAt(0) : this;
        return alphabet.indexOf(letter.toLowerCase());
    };

    function setCookie(cname, cvalue) {
        var d = new Date();
        d.setTime(d.getTime() + (365*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        console.log("Wrote cookie: " + cname + "=" + cvalue)
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function autojump(page){
        var jump = $('#autojump_select').val();
        if (jump == "Off"){
            return;
        }
        hidePresets();
        hideBanks();
        if (jump == "Match Page"){
            if (page == 1){
                showPresets('AH');
            } else {
                showPresets('IP');
            }
        } else if (jump == "All"){
            showPresets('AH');
            showPresets('IP');
        }
    }

    function hidediv(divname){
        var x = document.getElementById(divname);
        x.style.display = "none"
    }
    function showdiv(divname){
        var x = document.getElementById(divname);
        x.style.display = "block"
    }
    function showBanks(){
        hidePresets()
        showdiv("banks")
    }

    function hideBanks(){
        hidediv("banks")
    }

    function currentPage(){
        if (document.getElementById('banks').style.display == "block"){
            return "banks";
        } else {
            return "presets";
        }
    }

    function hidePresets(){
        hidediv("presets_ah")
        hidediv("presets_ip")
        hidediv("presets_op1")
        hidediv("presets_op2")
        hidediv("presets_op3")
        hidediv("presets_op4")
    }

    function showPresets(what, reset=false){
        hideBanks();
        if (reset == true){
            hidePresets();
        }
        if (what == "AH"){
            showdiv("presets_ah")
        } else if (what == "IP"){
            showdiv("presets_ip")
        } else if (what == "All"){
            showdiv("presets_ah")
            showdiv("presets_ip")
        }
        showOmniPorts();
    }

    function showOmniPorts(){
        if (currentPage() == "presets"){
            var portsArray=["1","2","3","4"];
            $.each($('#omniports_select').val(), function(index,val){
                showdiv("presets_op" + val)
                portsArray.indexOf(val) > -1 ? portsArray.splice(portsArray.indexOf(val), 1) : false
            })
            $.each(portsArray, function(index,val){
              hidediv("presets_op" + val)
            })
        }
    }

    cookie_midi_output = getCookie("midi_output");
    cookie_midi_channel = getCookie("midi_channel");
    cookie_omniports = getCookie("omniports");
    cookie_autojump = getCookie("autojump");

    $(document).ready(function(){

        var $select = $("#midi_channel");
        for (i=1;i<=16;i++){
            $select.append($('<option></option>').val(i).html(i))
        }
        outputs = []
        WebMidi.enable(function (err) {
            if (err) {
                console.log("WebMidi could not be enabled.", err);
            } else {
                console.log("WebMidi enabled!");
            }
            inputs = WebMidi.inputs;
            outputs = WebMidi.outputs;
            console.log("Midi Inputs: ");
            console.table(inputs);
            console.log("Midi Outputs");
            console.table(outputs)
            var $output_select = $("#midi_output");
            outputs.forEach(function(midiout){
                $output_select.append($('<option></option>').val(midiout.name).html(midiout.name))
            })
        }, true);
        $('select[multiple]').multiselect({
            columns: 1,
            placeholder: 'Select options',
            onOptionClick:function(element,option){
                showOmniPorts();
            }
        });

        if (cookie_midi_output != ""){
            $('#midi_output').val(cookie_midi_output);
        } else if (outputs.length > 0){
            setCookie(("midi_output", outputs[0].length))
        }

        if (cookie_midi_channel != ""){
            $("#midi_channel").val(cookie_midi_channel);
        }

        if (cookie_omniports != ""){
            var selectedOptions = cookie_omniports.split(",");
            $.each(selectedOptions, function(index,val){
                $('#ms-opt-' + val).trigger('click');
            })
        }

        if (cookie_autojump != ""){
            $('#autojump_select').val(cookie_autojump);
        }

        $( "#midi_output" ).change(function() {
            setCookie("midi_output", $(this).val())
        });

        $( "#midi_channel" ).change(function() {
            setCookie("midi_channel", $(this).val())
        });

        $( "#omniports_select" ).change(function() {
            setCookie("omniports", $(this).val())
        });

        $( "#autojump_select" ).change(function() {
            setCookie("autojump", $(this).val())
        });


    })

    function banksend(bank,page){
        var pcval = bank - 1;
        global_bank = bank;
        global_page = page;
        output_port = WebMidi.getOutputByName($('#midi_output').val());
        output_channel = $('#midi_channel').val();
        console.log("Sending BankChange; pc" + pcval + " to channel " + output_channel)
        output_port.sendProgramChange(pcval, output_channel, {})
        if (page == 2){
            var cc = 4;
            var val = 0
            console.log("Sending PageToggle; cc" + cc + "; val" + val )
            output_port.sendControlChange(cc,val,output_channel, {})
        }
        autojump(page)
    }

    function presetsend(letter){
        var numberval = letter.getPositionInAlphabet();
        var cc = numberval + 10
        var val = 1 //Simulate press
        output_port = WebMidi.getOutputByName($('#midi_output').val());
        output_channel = $('#midi_channel').val();
        console.log("Sending Preset Press; cc" + cc + "; val" + val)
        output_port.sendControlChange(cc,val,output_channel, {})
    }

</script>
</html>