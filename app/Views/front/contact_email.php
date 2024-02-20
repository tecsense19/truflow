<style>
    #result_div {
        padding: 0px 0px 0px;
        min-height: 30vh;
    }

    .h2 {
        font-size: 30px;
        font-weight: 800;
        line-height: 36px;
        color: #333333;
        margin: 0;
        margin: 30px;
    }

    .billing_add {
        font-family: Open Sans, Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
    }

    .bill_font {
        font-weight: 800;
        padding-bottom: 1px;
    }

    td {
        font-family: Open Sans, Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        padding: 5px 10px;

    }

    .notes {
        margin-top: 22px;
    }
    .main_table{
        padding: 5px 5px;
        border: 3px solid #eeeeee;
    }
</style>

<div id="result_div">
    <table align="center" cellpadding="0" cellspacing="0" width="50%" class="main_table">               
        <tr>
            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 0px;">
                <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.svg" width="125" style="display: block; border: 0px;" /><br>
                <h2>
                    Get in touch
                </h2>
            </td>
        </tr>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="50%" style="border: 3px solid #eeeeee; border-top: 0px;">
            <tr>
                <td class="billing_add" align="left" valign="top" style="width: 20%">
                    <p class="bill_font" style="margin: 10px 0px 10px 0px;">Name: </p>
                </td>
                <td class="billing_add" align="left" valign="top">
                    <p style="margin: 10px 0px 10px 0px;"><?php echo $contact_name; ?></p>
                </td>
            </tr>
            <tr>
                <td class="billing_add" align="left" valign="top" style="width: 20%">
                    <p class="bill_font" style="margin: 10px 0px 10px 0px;">Email: </p>
                </td>
                <td class="billing_add" align="left" valign="top">
                    <p style="margin: 10px 0px 10px 0px;"><?php echo $contact_email; ?></p>
                </td>
            </tr>
            <tr>
                <td class="billing_add" align="left" valign="top" style="width: 20%">
                    <p class="bill_font" style="margin: 10px 0px 10px 0px;">Company Name: </p>
                </td>
                <td class="billing_add" align="left" valign="top">
                    <p style="margin: 10px 0px 10px 0px;"><?php echo $company_name; ?></p>
                </td>
            </tr>
            <tr>
                <td class="billing_add" align="left" valign="top" style="width: 20%">
                    <p class="bill_font" style="margin: 10px 0px 10px 0px;">Phone No: </p>
                </td>
                <td class="billing_add" align="left" valign="top">
                    <p style="margin: 10px 0px 10px 0px;"><?php echo $contact_phone; ?></p>
                </td>
            </tr>
            <tr>
                <td class="billing_add" align="left" valign="top" style="width: 20%">
                    <p class="bill_font" style="margin: 10px 0px 10px 0px;">Message: </p>
                </td>
                <td class="billing_add" align="left" valign="top">
                    <p style="margin: 10px 0px 10px 0px;"><?php echo $message; ?></p>
                </td>
            </tr>
        </table>
    </table>
</div>