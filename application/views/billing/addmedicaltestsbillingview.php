<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/billingLayout_Header.php');
?>
<head>
 <script src="/<?php echo base_url();?>assets/js/Common/common.js"></script>
</head>

<div class="main-panel">
     <div class="content-wrapper add_billing_medicaltest_class">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Medical Tests Billing </h4>
                    
                    <form  id="add_billing_medicaltest"   method="post" enctype="multipart/form-data">
                         <div class="col-sm-12 col-12 form-group">
                              <label>Patient User Id : </label>
                              <select  class="form-control" name="add_billing_medicaltest_patient" id="add_billing_medicaltest_patient">
                              </select>
                        </div>

                   <!-- make dynamic input field --> 
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="item-row">
                                <th>Item</th>
                                <th>Price</th>
                              <!--   <th>Quantity</th> -->
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr id="hiderow">
                            <td colspan="5">
                                <a id="addRow" href="javascript:;" title="Add a row" class="btn btn-primary">Add a row</a>
                            </td>
                        </tr>
                        <!-- Here should be the item row -->
                        <!--<tr class="item-row">
                            <td><input class="form-control item" placeholder="Item" type="text"></td>
                            <td><input class="form-control price" placeholder="Price" type="text"></td>
                            <td><input class="form-control qty" placeholder="Quantity" type="text"></td>
                            <td><span class="total">0.00</span></td>
                        </tr>-->
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Sub Total</strong></td>
                            <td colspan="2"> <input class="form-control" id="subtotal" value="0" type="text" name="add_billing_medicaltest_subtotal" readonly></td>
                        </tr>
                        <tr>
                            <!-- <td><strong>Total Quantity: </strong><span id="totalQty" style="color: red; font-weight: bold">0</span> Units</td> -->
                            <td colspan="2"></td>
                            <td class="text-right"><strong>Discount</strong></td>
                            <td colspan="2"><input class="form-control" id="discount" value="0" type="text" name="add_billing_medicaltest_discount"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>GST</strong></td>
                            <td colspan="2">  <input class="form-control" id="gstamount" value="0" type="text" name="add_billing_medicaltest_gstamount" readonly> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Grand Total</strong></td>
                            <td colspan="2" > <input class="form-control" id="grandTotal" value="0" type="text" name="add_billing_medicaltest_grandtotal" readonly> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Paid Amount</strong></td>
                            <td colspan="2"><input class="form-control" id="paidamount" value="0" type="text" name="add_billing_medicaltest_paidamount"></td>
                        </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Due Amount</strong></td>
                            <td colspan="2"> <input class="form-control" id="dueamount" value="0" type="text" name="add_billing_medicaltest_dueamount" readonly>   </td>
                        </tr>

                        </tbody>
                    </table>
                </div>


                        <div class="col-sm-12" style="text-align: center;">
                          <div id="billingmedicaltest-addmsg"></div>
                          <button type="button" id="addbillingmedicaltest" class="btn btn-primary">Save</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>

                  
                         </form>

                </div>
              </div>
            </div>
          </div>
        </div>


<?php
include('Layouts/billingLayout_Footer.php');
?>

 <script >
   
   (function (jQuery) {
	   
    $.opt = {};  // jQuery Object

    jQuery.fn.invoice = function (options) {
        var ops = jQuery.extend({}, jQuery.fn.invoice.defaults, options);
        $.opt = ops;
        var inv = new Invoice();
        inv.init();
        jQuery('body').on('click', function (e) {
            var cur = e.target.id || e.target.className;
			
			if (cur == $.opt.addRow.substring(1))
                inv.newRow();

            if (cur == $.opt.delete.substring(1))
                inv.deleteRow(e.target);

            inv.init();
        });
		

        jQuery('body').on('keyup', function (e) {
            inv.init();
        });

        return this;
    };
}(jQuery));

function Invoice() {
    self = this;
	  i=0;
}

Invoice.prototype = {
    constructor: Invoice,

    init: function () {
        this.calcTotal();
        this.calcSubtotal();
        this.calcGst();
        this.calcGrandTotal();
        this.calcDueAmount();
    },

    /**
     * Calculate total price of an item.
     *
     * @returns {number}
     */
    calcTotal: function () {
         jQuery($.opt.parentClass).each(function (i) {
             var row = jQuery(this);
             var total = row.find($.opt.price).val() *1;
             total = self.roundNumber(total, 2);
             row.find($.opt.total).html(total);
         });

         return 1;
     },
  

    /***
     * Calculate subtotal of an order.
     *
     * @returns {number}
     */
    calcSubtotal: function () {
         var subtotal = 0;
         jQuery($.opt.total).each(function (i) {
             var total = jQuery(this).html();
             if (!isNaN(total)) subtotal += Number(total);
         });

         subtotal = self.roundNumber(subtotal, 2);
         jQuery($.opt.subtotal).val(subtotal);

         return 1;
     },

    /**
     * Calculate grand total of an order.
     *
     * @returns {number}
     */
    calcGst: function () {
        var gstamount1 = Number(jQuery($.opt.subtotal).val())
                       - Number(jQuery($.opt.discount).val());
        var gstamount=gstamount1 * 18/100 ;
        gstamount = self.roundNumber(gstamount, 2);
        jQuery($.opt.gstamount).val(gstamount);
        return 1;
    }, 

    calcGrandTotal: function () {
        var grandTotal = Number(jQuery($.opt.subtotal).val())
                       + Number(jQuery($.opt.gstamount).val())
                       - Number(jQuery($.opt.discount).val());
        grandTotal = self.roundNumber(grandTotal, 2);
        jQuery($.opt.grandTotal).val(grandTotal);
        return 1;
    },


    calcDueAmount: function () {
        var dueamount = Number(jQuery($.opt.grandTotal).val())
                       - Number(jQuery($.opt.paidamount).val());

                     //  alert(dueamount);
        dueamount = self.roundNumber(dueamount, 2);
        jQuery($.opt.dueamount).val(dueamount);
        return 1;


    },
   





    /**
     * Add a row.
     *
     * @returns {number}
     */
	 //i=0;
    newRow: function () { 
     //var i=0;
     //i=this.cnt;	 
    id1='add_billing_medicaltest_medicaltest'+i;  
		priceele='price'+i;
		//getPrices();
		getMedicalTest1('#'+id1);

        jQuery(".item-row:last").after('<tr class="item-row"> <td class="item-name">  <div class="delete-btn"> <select  class="form-control add_billing_medicaltest_medicaltest" name="add_billing_medicaltest_medicaltest[]" id='+id1+'  style="width: 100%;"></select></div></td> <td><input class="form-control price" name="price[]" value="0" id='+priceele+'  placeholder="Price" type="text" readonly> </td><td><span class="total">0.00</span></td> <td> <a class=' + $.opt.delete.substring(1) + ' href="javascript:;" title="Remove row">X</a> </td> </tr>');
    i++;
        if (jQuery($.opt.delete).length > 0) {
            jQuery($.opt.delete).show();
        }

        return 1;
    },
	

    /**	
     * Delete a row.
     *
     * @param elem   current element
     * @returns {number}
     */
    deleteRow: function (elem) {
        jQuery(elem).parents($.opt.parentClass).remove();

        if (jQuery($.opt.delete).length < 2) {
            jQuery($.opt.delete).hide();
        }

        return 1;
    },

    /**
     * Round a number.
     * Using: http://www.mediacollege.com/internet/javascript/number/round.html
     *
     * @param number
     * @param decimals
     * @returns {*}
     */
    roundNumber: function (number, decimals) {
        var newString;// The new rounded number
        decimals = Number(decimals);

        if (decimals < 1) {
            newString = (Math.round(number)).toString();
        } else {
            var numString = number.toString();

            if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
                numString += ".";// give it one at the end
            }

            var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
            var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
            var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want

            if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
                if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                    while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                        if (d1 != ".") {
                            cutoff -= 1;
                            d1 = Number(numString.substring(cutoff, cutoff + 1));
                        } else {
                            cutoff -= 1;
                        }
                    }
                }

                d1 += 1;
            }

            if (d1 == 10) {
                numString = numString.substring(0, numString.lastIndexOf("."));
                var roundedNum = Number(numString) + 1;
                newString = roundedNum.toString() + '.';
            } else {
                newString = numString.substring(0, cutoff) + d1.toString();
            }
        }

        if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
            newString += ".";
        }

        var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;

        for (var i = 0; i < decimals - decs; i++)
            newString += "0";
        //var newNumber = Number(newString);// make it a number if you like

        return newString; // Output the result to the form field (change for your purposes)
    }
};

/**
 *  Publicly accessible defaults.
 */
jQuery.fn.invoice.defaults = {
    addRow: "#addRow",
    delete: ".delete",
    parentClass: ".item-row",
    price: ".price",
    total: ".total",
    subtotal: "#subtotal",
    discount: "#discount",
    gstamount: "#gstamount",
    grandTotal: "#grandTotal",
    paidamount: "#paidamount",
    dueamount: "#dueamount",
	
};

 </script>
    <script>
        jQuery(document).ready(function(){
            // alert("inside");
			  jQuery('body').on('change','.add_billing_medicaltest_medicaltest',function(e){
				selitem=e.target.id;
				lastchar=selitem.substr(selitem.length-1);
			
				ele='#price'+lastchar;
				testid=$('#'+selitem).val();
				//getPrices();
				getPrice(ele,testid);
				//ele=$('#'+list1.substr(list1.length-1));
			
			});
			jQuery().invoice({
                addRow : "#addRow",
                delete : ".delete",
                parentClass : ".item-row",
                price : ".price",
                total : ".total",
                subtotal : "#subtotal",
                discount: "#discount",
                gstamount:"#gstamount",
                grandTotal : "#grandTotal",
                paidamount: "#paidamount",
                dueamount: "#dueamount",
                
            });
			
			
        });
    </script>



 <script src="/<?php echo base_url();?>assets/js/Common/PatientBillingTestController.js" type="text/javascript"></script>
<script type="text/javascript">
  getPatientPrescriptionList("#add_billing_medicaltest_patient");
</script>