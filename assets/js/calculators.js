/*---------------------------
   Calculators
------------------------------*/

function monthlyPayment()  {
    //$('#input_month_abc').css('display','block');
    document.getElementById('input_month_abc').style.display='block';
    document.getElementById('input_year').style.display='none';
    var loanamt=parseFloat(document.getElementById('mortgage_amnt').value);
    var rate=parseFloat(document.getElementById('mortgage_rt').value);
    var years=parseFloat(document.getElementById('mortgage_yrs').value);
    //here is the amortization formula:
    var payment2=loanamt*Math.pow((1+(rate/100)),years)*(rate/100)*(1/(Math.pow(1+(rate/100),years)-1))*(1/12);
    var payment=Math.round(payment2*100)/100;
    document.getElementById('lins_totIns_month').value = "£" + (payment).toLocaleString('en', { minimumFractionDigits: 2 });
    $(".tabimageone").hide(); //hides div.
    $("#tab-1").addClass("no-margin");
    //;
}

function interestOnly() {
    var loanamt = parseFloat(document.getElementById('mortgage_amnt').value);
    var rate = parseFloat(document.getElementById('mortgage_rt').value);
    var interest2 = rate * loanamt / 1200;
    var interest = Math.round(interest2 * 100) / 100;
    document.getElementById('input_month_abc').style.display = 'none';
    document.getElementById('input_year').style.display = 'block';
    document.getElementById('lins_totIns_year').value = "£" + (interest).toLocaleString('en', {minimumFractionDigits: 2});
    $(".tabimageone").hide(); //hides div.
    $("#tab-1").addClass("no-margin");
}

function ClearFields() {

    document.getElementById("mortgage_amnt").value = "";
    document.getElementById("mortgage_rt").value = "";
    document.getElementById("mortgage_yrs").value = "";
    $("#input_month_abc").hide(); //hides div.
    $("#input_year").hide(); //hides div.
    $(".tabimageone").show(); //shows div.
    $("#tab-1").removeClass("no-margin");
}




function go2()  {
// user inputs:
    var ap1i = parseFloat(document.getElementById('hpib_salary1').value);
    var ap2i = parseFloat(document.getElementById('hpib_salary2').value);
    var apit = Math.round((ap1i+ap2i)*100)/100; // joint  gross income
    document.getElementById('hpib_salary12').value = apit;
    var ap1net = ap1i; //app 1 net income
    var ap2net = ap2i; //app 2 net income
    var ap12net = Math.round((ap1net+ap2net)*100)/100; //joint net income
    document.getElementById('hpib_salary12').value = ap12net;
    var the25 = parseFloat(document.getElementById('hpib_two5').value);
    document.getElementById('hpib_net2').value= ap12net;
    document.getElementById('hpib_sum25').value= "£" + (Math.round((the25*ap12net)*1000)/1000).toLocaleString('en', { minimumFractionDigits: 2 }); //2nd result
    document.getElementById('resultsof').style.display='block';
    $(".tabimagetwo").hide(); //hides div.
    $("#tab-2").addClass("no-margin");

}

//document.getElementById('hpib_salary12').disabled=true;

function ClearFields3() {

    document.getElementById("hpib_salary1").value = "";
    document.getElementById("hpib_salary2").value = "";
    document.getElementById("hpib_salary12").value = "";
    $("#resultsof").hide(); //hides div.
    $(".tabimagetwo").show(); //shows div.
    $("#tab-2").removeClass("no-margin");

}