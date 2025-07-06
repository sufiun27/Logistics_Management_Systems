<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW sales_reports_view AS
            SELECT
                ef.invoice_site,
                sd.invoice_no,
                ef.invoice_date,
                ef.consignee_name,
                ef.contract_date,
                sd.order_no,
                sd.style_no,
                ef.item_name,
                sd.product_type,
                ef.ex_factory_date,
                s.cargorpt_date,
                sd.shipbording_date,
                sd.bl_no,
                sd.bl_date,
                sd.eta_date,
                ef.quantity,
                ef.incoterm,
                COALESCE(ef.amount, 0) AS amount,
                ef.freight_value,
                COALESCE(ef.amount, 0) - COALESCE(ef.freight_value, 0) AS fob,
                ef.cm_amount,
                sd.shipped_qty,
                sd.shipped_fob_value,
                sd.shipped_cm_value,
                s.transport_port,
                sd.carton_qty,
                sd.cbm_value,
                ef.exp_no,
                ef.exp_date,
                sd.vessel_name,
                s.ep_date,
                s.cnf_agent,
                ef.dst_country_name,
                ef.dst_country_port,
                s.sb_no,
                s.sb_date,
                sd.final_qty,
                sd.final_fob,
                sd.final_cm,
                sd.remarks
            FROM sale_details sd
            JOIN export_form_apparels ef ON sd.invoice_no = ef.invoice_no
            JOIN shippings s ON s.invoice_no = sd.invoice_no
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS sales_reports_view');
    }
};
