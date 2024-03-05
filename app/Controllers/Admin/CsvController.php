<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ChildSubCategoryModel;
use App\Models\ProductModel;
use App\Models\VariantsModel;
use App\Models\CouponModel;

class CsvController extends BaseController
{
    public function processCSV()
    {
        $session = session();
        $categoryModel = new CategoryModel();
        $subcategoryModel = new SubCategoryModel();
        $childsubcategorymodel = new ChildSubCategoryModel();
        $productModel = new ProductModel();
        $variantModel = new VariantsModel();
        $couponModel = new CouponModel();

        // Get the uploaded CSV file
        $csvFile = $this->request->getFile('csv_file');
        // Check if a file was uploaded
        if ($csvFile->isValid() && $csvFile->getExtension() === 'csv') {
            // Open the CSV file
            // $productModel->set(['deleted_at' => '1'])->update();
            $db = \Config\Database::connect();
            $data = [
                'deleted_at' => 1,
                // Add more columns and values as needed
            ];
            $db->table('product')->update($data);
            $csvData = array_map('str_getcsv', file($csvFile->getTempName()));

            $categoryName = null;
            $categoryId = null;

            $subcategoryName = null;
            $subcategoryId = null;

            $productId = null;
            $child_id = null;

            $compressedPath = null;

            $isFirstRow = true; // Flag variable to skip the first row
            // // Process each row of the CSV file
            foreach ($csvData as $row) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue; // Skip the first row
                }

                if (isset($row[18]) && trim($row[18]) != '') 
                {
                    // Category name
                    $categoryName = str_replace('Â°', '°', utf8_encode(trim($row[18])));

                    // Check if the category already exists
                    $category = $categoryModel->where('category_name', $categoryName)->first();

                    if (!$category) {
                        $categoryId = $categoryModel->insert([ 'category_name' => $categoryName ]);
                    } else {
                        $category = $categoryModel->where('category_name', $categoryName)->get()->getRow();
                        $categoryId = $category->category_id;
                    }
                }

                if (isset($row[19]) && trim($row[19]) != '') {
                    // Subcategory name
                    $subcategoryName = str_replace('Â°', '°', utf8_encode(trim($row[19])));

                    // Check if the subcategory already exists
                    $subcategory = $subcategoryModel->where('sub_category_name', $subcategoryName)->where('category_id', $categoryId)->first();

                    if (!$subcategory) {
                        // Insert the new subcategory with the parent category ID
                        $subcategoryId = $subcategoryModel->insert([ 'sub_category_name' => $subcategoryName, 'category_id' => $categoryId ]);
                    } else {
                        $subcategory = $subcategoryModel->where('sub_category_name', $subcategoryName)->where('category_id', $categoryId)->get()->getRow();
                        $subcategoryId = $subcategory->sub_category_id;
                    }
                }

                if (isset($row[17]) && trim($row[17]) != '') {
                    $imageName = basename(trim($row[17]));
                
                    // Define the destination folder for the product images
                    $destinationFolder = base_url() . 'public/admin/images/product/';
                
                    // Generate a unique filename based on the current timestamp
                    // You can change the file extension to .png if needed
                    $encodedFilename = str_replace('+', '%20', urlencode(basename($row[17])));
                    $product_img_csv = dirname($row[17]) . '/' . $encodedFilename;

                    // Define the local destination path
                    $destinationPath = $destinationFolder . $imageName;
                
                    $imageName = time(). '_' . $encodedFilename;

                    // Local path to save the compressed image
                    $localPath = 'public/admin/images/product/'.$imageName; // Adjust the path as needed

                    $headers = get_headers($product_img_csv);
                    if ($headers && strpos($headers[0], '200 OK') !== false) {
                        $imageData = file_get_contents($product_img_csv);
                        if ($imageData !== false) {
                            // Save the original image locally
                            file_put_contents($localPath, $imageData);

                            // Compress the image
                            $image = \Config\Services::image()
                                ->withFile($localPath)
                                // ->rotate(180) // You can apply other manipulations as needed
                                ->save($localPath, 80); // Adjust the quality as needed (0-100)

                            $compressedPath = $localPath;
                        }
                    }
                }                

                if (isset($row[20]) && trim($row[20]) != '') {
                    // Subcategory name
                    // Assuming the first column (index 0) contains the variable names var1, var2, var3, etc.
                    // Loop through each column starting from index 1 (skipping the first column with variable names)
                    for ($i=20; $i < count($row); $i++) {
                        if($i != 20)
                        {
                            // $childsubcategoryName = utf8_encode(trim($row[$i]));
                            $childsubcategoryName = str_replace('Â°', '°', utf8_encode(trim($row[$i])));
                            $existingChildSubCategory = $childsubcategorymodel->where('child_sub_category_name', $childsubcategoryName)
                                                                                ->where('sub_category_name',$row[$i - 1])
                                                                            ->where('category_id', $categoryId)->get()->getRow();

                            if (isset($row[$i]) && $row[$i] != '' && !$existingChildSubCategory) {
                                $childsubcategory = $childsubcategorymodel->where('child_sub_category_name', $row[$i - 1])
                                                                            ->where('category_id', $categoryId)->orderBy('child_id', 'desc')->get()->getRow();

                                /*$childsubcategory = $childsubcategorymodel->where('child_sub_category_name', $childsubcategory->child_sub_category_name)
                                                                            ->where('category_id', $categoryId)->get()->getRow();*/
                                $childsubcategory_1 = [
                                    'child_sub_category_name' => isset($childsubcategoryName) ? $childsubcategoryName : '',
                                    'sub_category_name' => $row[$i - 1],
                                    'sub_chid_id' => isset($childsubcategory) ? $childsubcategory->child_id : '0',
                                    'sub_category_id' =>  isset($childsubcategory) ? $childsubcategory->sub_category_id : '0',
                                    'category_id' => $categoryId
                                ];

                                $child_id = $childsubcategorymodel->insert($childsubcategory_1);
                            }

                            if(isset($existingChildSubCategory))
                            {
                                $child_id = $existingChildSubCategory->child_id;
                            }
                        }
                        else
                        {
                            $childsubcategoryName = str_replace('Â°', '°', utf8_encode(trim($row[$i])));
                            $subcategory = $subcategoryModel->where('sub_category_name', $row[$i - 1])
                                                            ->where('category_id', $categoryId)->get()->getRow();

                            if (isset($row[$i]) && $row[$i] != '') {
                                $existingChildSubCategory = $childsubcategorymodel->where('child_sub_category_name', $childsubcategoryName)->where('sub_category_name',$row[$i - 1])->where('category_id', $categoryId)->get()->getRow();

                                if (!$existingChildSubCategory) {
                                    $childsubcategory_1 = [
                                        'child_sub_category_name' => $childsubcategoryName,
                                        'sub_category_name' => $row[$i - 1],
                                        'sub_chid_id' => 0,
                                        'sub_category_id' => isset($subcategory) ? $subcategory->sub_category_id : '0',
                                        'category_id' => $categoryId
                                    ];
                                    $child_id = $childsubcategorymodel->insert($childsubcategory_1);
                                }
                                else
                                {
                                    $child_id = $existingChildSubCategory->child_id;
                                }
                            }
                        }
                    }
                }              

                // Product details
                $productName = str_replace('Â°', '°', utf8_encode($row[0]));
                $Favourite   = utf8_encode($row[6]);
                $ProductDescription = utf8_encode($row[7]);
                $shortDescription = str_replace('Â°', '°', utf8_encode($row[8]));
                $information = utf8_encode($row[9]);
                $vheader1 = utf8_encode($row[10]);
                $vheader2 = utf8_encode($row[11]);
                $vheader3 = utf8_encode($row[12]);
                $vheader4 = utf8_encode($row[13]);

                $discount_code = utf8_encode($row[14]);
                $group_name = utf8_encode($row[15]);
                $sort = utf8_encode($row[16]);

                $db = \Config\Database::connect();
                $query_test = $db->table('coupon')->select('coupon_id')->where('coupon_code', $discount_code)->get();

                if ($query_test->getNumRows() > 0) {
                    $row_num = $query_test->getRow(); // Fetch the row
                    $CouponId = $row_num->coupon_id; // Get the coupon_id
                    //echo "Coupon ID: " . $CouponId;
                } else{
                    $CouponId = "0";
                }               

                if ($productName != '') {
                    // Insert the product
                    $checkProduct = $productModel->where('product_name', $productName)->where('category_id', $categoryId)->where('sub_category_id', $subcategoryId)->get()->getRow();
                    $product = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'child_id' => $child_id,
                        'sub_category_id' => $subcategoryId,
                        'product_description' => $ProductDescription,
                        'product_short_description' => $shortDescription,
                        'product_header1' => trim($vheader1, "'") ? trim($vheader1, "'") : '',
                        'product_header2' => trim($vheader2, "'") ? trim($vheader2, "'") : '',
                        'product_header3' => trim($vheader3, "'") ? trim($vheader3, "'") : '', 
                        'product_header4' => trim($vheader4, "'") ? trim($vheader4, "'") : '',
                        'product_additional_info' => $information,
                        'product_favourite' => $Favourite,
                        'coupon_id' => $CouponId,
                        'deleted_at' => 0,
                        'sort' => trim($sort, "'"),
                    ];

                    if($compressedPath)
                    {
                        $product['product_img_csv'] = $compressedPath;
                        $product['product_img'] = $compressedPath;

                        if (isset($checkProduct->product_img_csv)) {
                            $proFilePath = FCPATH . $checkProduct->product_img_csv;
                            if (is_file($proFilePath)) {
                                unlink($proFilePath);
                            }
                        }
                    }

                    if($checkProduct)
                    {
                        $productId = $checkProduct->product_id;
                        $productModel->update($checkProduct->product_id, $product);
                    }
                    else
                    {
                        $productId = $productModel->insert($product);
                    }
                }
          
                // Variant details
                $variantName = str_replace('Â°', '°', utf8_encode($row[1]));
                $variantPrice = utf8_encode($row[2]);
                $variantSku = utf8_encode($row[3]);
                $stock = utf8_encode($row[4]);
                $parent = utf8_encode($row[5]);


                if ($variantName != '') {
                    // Insert the variant
                    $variant = [
                        'product_id' => $productId,
                        'variant_name' => $variantName,
                        'variant_price' => $variantPrice,
                        'variant_sku' => $variantSku,
                        'parent' => $parent,
                        'variant_stock' => $stock,
                        'group_name' => $group_name,
                        'sort' => trim($sort, "'"),
                        'variant_description' => trim($vheader1, "'") ? trim($vheader1, "'") : '',
                        'variant_description_1' => trim($vheader2, "'") ? trim($vheader2, "'") : '',
                        'variant_description_2' => trim($vheader3, "'") ? trim($vheader3, "'") : '',
                        'variant_description_3' => trim($vheader4, "'") ? trim($vheader4, "'") : '',
                    ];

                    $checkVariant = $variantModel->where('variant_name', $variantName)->where('variant_sku', $variantSku)->where('product_id', $productId)->get()->getRow();
                    if($checkVariant)
                    {
                        $variantModel->update($checkVariant->variant_id, $variant);
                    }
                    else
                    {
                        $variantModel->insert($variant);
                    }

                    $checkCoupon = $couponModel->where('coupon_code', $group_name)->get()->getRow();
                    
                    // date
                    $from_date = date('Y-m-d');
                    $to_date_timestamp  = strtotime($from_date . ' +2 years');
                    $to_date = date('Y-m-d', $to_date_timestamp);
                    $coupon_date = array(
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'coupon_code' => $group_name,
                        'company_coupon' => 1
                    );
                    

                    if($checkCoupon)
                    {
                        if($group_name)
                        {
                            // $couponModel->update($checkCoupon->coupon_id, array('coupon_code' => $group_name, 'company_coupon' => 1));
                            $couponModel->update($checkCoupon->coupon_id, $coupon_date);
                            // $productModel->update($productId, array('coupon_id' => $checkCoupon->coupon_id));
                        }
                    }
                    else
                    {
                        if($group_name)
                        {
                            // $coupon_id = $couponModel->insert(array('coupon_code' => $group_name, 'company_coupon' => 1));
                            $coupon_id = $couponModel->insert($coupon_date);
                            // $productModel->update($productId, array('coupon_id' => $coupon_id));
                        }
                    }
                }  
            }
            

            // Success message or redirect to a success page
            $session->setFlashdata('success', 'Uploaded the CSV file successfully.');
            return redirect()->to('admin/product_list');
        } else {
            // Error message or redirect to an error page
            $session->setFlashdata('error', 'Failed to upload the CSV file.');
            return redirect()->to('admin/product_list');
        }
    }
}