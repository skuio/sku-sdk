<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\DataType\Import;
use Skuio\Sdk\DataType\Product;
use Skuio\Sdk\DataType\ProductAttribute;
use Skuio\Sdk\DataType\ProductPricing;
use Skuio\Sdk\DataType\SupplierProduct;
use Skuio\Sdk\DataType\SupplierProductPricing;
use Skuio\Sdk\Query;
use Skuio\Sdk\Service\Products;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductsTest extends TestCase
{
    private $username = 'e89c5ec96cdbfe1f50f015ae5161c65f';
    private $password = '1656c8a98da2522be959d7523f011a86';

//  public function testConnection()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $sdk = new Sdk();
//    $res = $sdk->authorizedRequest( '/products', [] );
//
//    $this->assertInstanceOf( Response::class, $res );
//
//    $this->assertEquals( 200, $res->getStatusCode() );
//  }
//
//  public function testGetProducts()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $product                 = new Product();
//    $product->sku            = '123';
//    $product->name           = 'Product Test';
//    $product->brand_name     = 'Brand Test';
//    $product->type           = Product::TYPE_STANDARD;
//    $product->weight         = 15.2;
//    $product->weight_unit    = Product::WEIGHT_UNIT_LB;
//    $product->height         = 5.4;
//    $product->width          = 3.4;
//    $product->length         = 2.4;
//    $product->dimension_unit = Product::DIMENSION_UNIT_INCH;
//
//    ( new Products() )->store( $product );
//
//    $productsRequest = new Request();
//    $productsRequest->setConjunction( 'and' );
//    $productsRequest->addFilter( 'sku', '=', '123' );
//
//    $products = new Products();
//    $products = $products->get( $productsRequest );
//
//    $this->assertEquals( 200, $products->getStatusCode() );
//    $this->assertEquals( 1, count( $products->getData() ) );
//  }
//
//  public function testShowProductById()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productId = 1;
//    $products  = new Products();
//    $products  = $products->showById( $productId );
//
//    $this->assertEquals( 200, $products->getStatusCode() );
//
//    $this->assertEquals( $products->getData()['id'], $productId );
//  }
//
//  public function testShowProductBySku()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productSku = '5333180491623';
//    $products   = new Products();
//    $products   = $products->showBySku( $productSku );
//
//    $this->assertEquals( 200, $products->getStatusCode() );
//
//    $this->assertEquals( $products->getData()['sku'], $productSku );
//
//    echo "\n" . $products->getResponse()['data']['name'] . "\n";
//  }
//
//  public function testStoreProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $product                 = new Product();
//    $product->sku            = '1234567891';
//    $product->name           = 'my first test';
//    $product->brand_name     = 'test brand';
//    $product->type           = 'standard';
//    $product->weight         = 15.2;
//    $product->weight_unit    = 'kg';
//    $product->height         = 5.4;
//    $product->width          = 3.4;
//    $product->length         = 2.4;
//    $product->dimension_unit = 'cm';
//    $product->description    = 'first test description';
//    $product->image          = 'https://homepages.cae.wisc.edu/~ece533/images/cat.png';
//    $product->download_image = true;
//    $product->tags           = [ 'Test', 'First', 'Brand' ];
//
//    // Pricing
//    $product->pricing = [ new ProductPricing( [ 'product_pricing_tier_name' => 'Retail', 'price' => 58.5 ] ) ];
//
//    // Source
//    $supplierProduct               = new SupplierProduct();
//    $supplierProduct->supplier_id    = 1;
//    $supplierProduct->is_default   = true;
//    $supplierProduct->supplier_sku = 'AABB1';
//    $supplierProduct->pricing      = [ new SupplierProductPricing( [ 'supplier_pricing_tier_id' => 1, 'price' => 50.5 ] ) ];
//
//    $product->suppliers = [ $supplierProduct ];
//
//    // Taxonomy
//    $attribute              = new ProductAttribute();
//    $attribute->name        = 'test attribute';
//    $attribute->value       = 'attribute value';
//    $attribute->has_options = false;
//
//    $product->attributes = [ $attribute ];
//
//    $products = new Products();
//
//    $products = $products->store( $product );
//
//    $this->assertEquals( 201, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
//
//  public function testUpdateProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $product         = new Product();
//    $product->id     = 2;
//    $product->weight = 20.5;
//
//    $products = new Products();
//
//    $products = $products->update( $product );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }

    public function testSetProductInitialInventory()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $product         = new Product();
        $product->id     = 1712;

        $product->setInitialInventory(1, 200, 10);
        $product->setInitialInventory(2, 200, 5);

        $products = new Products();

        $products = $products->update( $product );

        $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
    }


    public function testItCanGetProductBundles() {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $productId     = 1712;

        $products = new Products();

        $products = $products->bundles( $productId );

        $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
    }

    public function testItCanGetProductComponents() {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $productId     = 556298;

        $products = new Products();

        $products = $products->components( $productId );

        $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
    }


    public function testItCanAddProductComponents() {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $product = new Product;
        $product->id = $productId = 556298;

        $products = new Products();

        $request = $products->components( $productId );
        $components = $request->getResponse();
        $this->assertNotEmpty($components);

        // Add existing components
        $product->addBundleComponents($components);

        // Add a new bundle
        $newComponentId = 556270;
        $product->addBundleComponent($newComponentId, 4);


        $request = $products->update($product);

        $this->assertEquals( 200, $request->getStatusCode(), json_encode( $request->getResponse() ) );
    }


    public function testItCanRemoveProductComponents() {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $product = new Product;
        $product->id = $productId = 556298;

        $products = new Products();

        $request = $products->components( $productId );
        $components = $request->getResponse();
        $this->assertNotEmpty($components);

        // Add existing components
        $product->addBundleComponents($components);

        // Remove 1 bundle item
        $componentId = 556270;
        $product->removeBundleComponent($componentId);


        $request = $products->update($product);

        $this->assertEquals( 200, $request->getStatusCode(), json_encode( $request->getResponse() ) );
    }



//  public function testArchiveProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productId = 1;
//    $products  = new Products();
//    $products  = $products->archive( $productId );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
//
//  public function testUnArchiveProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productId = 1;
//    $products  = new Products();
//    $products  = $products->unarchived( $productId );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
//
//  public function testDeleteProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productId = 1;
//    $products  = new Products();
//    $products  = $products->delete( $productId );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
//
//  public function testRestoreProduct()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $productSKU = '1123410-FBA11';
//    $products   = new Products();
//    $products   = $products->restore( $productSKU );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
//
//  public function testImportProducts()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $import           = new Import();
//    $import->csv_file = './tests/import_products_test2.csv';
//
//    $products = new Products();
//    $products = $products->import( $import );
//
//    print_r( $products->getResponse() );
//
//    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
//  }
}