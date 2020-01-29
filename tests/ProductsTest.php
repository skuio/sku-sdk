<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\Product;
use Skuio\Sdk\Model\ProductAttribute;
use Skuio\Sdk\Model\ProductPricing;
use Skuio\Sdk\Model\VendorProduct;
use Skuio\Sdk\Model\VendorProductPricing;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\Products;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductsTest extends TestCase
{
  private $username = '86be828e14eec146b3bd45ef72ece6c3';
  private $password = '28380a285cb463a3bad45d6f608395b1';

  public function testConnection()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $sdk = new Sdk();
    $res = $sdk->authorizedRequest( '/products', [] );

    $this->assertInstanceOf( Response::class, $res );

    $this->assertEquals( 200, $res->getStatusCode() );
  }

  public function testGetProducts()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $product                 = new Product();
    $product->sku            = '123';
    $product->name           = 'Product Test';
    $product->brand_name     = 'Brand Test';
    $product->type           = Product::TYPE_STANDARD;
    $product->weight         = 15.2;
    $product->weight_unit    = Product::WEIGHT_UNIT_LB;
    $product->height         = 5.4;
    $product->width          = 3.4;
    $product->length         = 2.4;
    $product->dimension_unit = Product::DIMENSION_UNIT_INCH;

    ( new Products() )->store( $product );

    $productsRequest = new Request();
    $productsRequest->setConjunction( 'and' );
    $productsRequest->addFilter( 'sku', '=', '123' );

    $products = new Products();
    $products = $products->get( $productsRequest );

    $this->assertEquals( 200, $products->getStatusCode() );
    $this->assertEquals( 1, count( $products->getData() ) );
  }

  public function testShowProductById()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId = 1;
    $products  = new Products();
    $products  = $products->showById( $productId );

    $this->assertEquals( 200, $products->getStatusCode() );

    $this->assertEquals( $products->getData()['id'], $productId );
  }

  public function testShowProductBySku()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productSku = '5333180491623';
    $products   = new Products();
    $products   = $products->showBySku( $productSku );

    $this->assertEquals( 200, $products->getStatusCode() );

    $this->assertEquals( $products->getData()['sku'], $productSku );

    echo "\n" . $products->getResponse()['data']['name'] . "\n";
  }

  public function testStoreProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $product                 = new Product();
    $product->sku            = '1234567891';
    $product->name           = 'my first test';
    $product->brand_name     = 'test brand';
    $product->type           = 'standard';
    $product->weight         = 15.2;
    $product->weight_unit    = 'kg';
    $product->height         = 5.4;
    $product->width          = 3.4;
    $product->length         = 2.4;
    $product->dimension_unit = 'cm';
    $product->description    = 'first test description';
    $product->image          = 'https://homepages.cae.wisc.edu/~ece533/images/cat.png';
    $product->download_image = true;
    $product->tags           = [ 'Test', 'First', 'Brand' ];

    // Pricing
    $product->pricing = [ new ProductPricing( [ 'product_pricing_tier_name' => 'Retail', 'price' => 58.5 ] ) ];

    // Source
    $vendorProduct               = new VendorProduct();
    $vendorProduct->vendor_id    = 1;
    $vendorProduct->is_default   = true;
    $vendorProduct->supplier_sku = 'AABB1';
    $vendorProduct->pricing      = [ new VendorProductPricing( [ 'vendor_pricing_tier_id' => 1, 'price' => 50.5 ] ) ];

    $product->vendors = [ $vendorProduct ];

    // Taxonomy
    $attribute              = new ProductAttribute();
    $attribute->name        = 'test attribute';
    $attribute->value       = 'attribute value';
    $attribute->has_options = false;

    $product->attributes = [ $attribute ];

    $products = new Products();

    $products = $products->store( $product );

    $this->assertEquals( 201, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testUpdateProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $product         = new Product();
    $product->id     = 2;
    $product->weight = 20.5;

    $products = new Products();

    $products = $products->update( $product );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testArchiveProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId = 1;
    $products  = new Products();
    $products  = $products->archive( $productId );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testUnArchiveProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId = 1;
    $products  = new Products();
    $products  = $products->unarchived( $productId );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testDeleteProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId = 1;
    $products  = new Products();
    $products  = $products->delete( $productId );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testRestoreProduct()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productSKU = '1123410-FBA11';
    $products   = new Products();
    $products   = $products->restore( $productSKU );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }

  public function testImportProducts()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $import           = new Import();
    $import->csv_file = './tests/import_products_test2.csv';

    $products = new Products();
    $products = $products->import( $import );

    print_r( $products->getResponse() );

    $this->assertEquals( 200, $products->getStatusCode(), json_encode( $products->getResponse() ) );
  }
}