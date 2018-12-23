<?php

function rentit_jalali_archive_product_narrower(){
	return strtotime( sanitize_text_field( urldecode( $_GET['gregorian_start_date'] ) ) );
}