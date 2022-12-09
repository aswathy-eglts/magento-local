<?php
declare(strict_types=1);

namespace Egits\Product\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\Catalog\Model\Product;

/**
 * Class CityImport
 *
 * @package Eltrino\MeestExpress\Console\Command
 */
class FirstCommand extends Command
{

    const PRODUCT_SKU_ARGUMENT = 'product_sku';

    /**
     * @var StockItemRepository
     */
    private $stockItemRepository;

    /**
     * @var Product
     */
    private $product;
    
   

    /**
     * {@inheritDoc}
     */
    public function __construct(
        StockItemRepository $stockItemRepository,
        Product $product,
    ) {
        parent::__construct();
        $this->stockItemRepository = $stockItemRepository;
        $this->product             = $product;
                
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('egits:cli:first');
        $this->setDescription('Get product qty by SKU');

        //add argument to our command
        $this->addArgument(self::PRODUCT_SKU_ARGUMENT, InputArgument::REQUIRED, 'Product SKU');

        parent::configure();
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
       
        //get argument value from input
        $productSku = $input->getArgument(self::PRODUCT_SKU_ARGUMENT);

        //get product entity_id by sku
        $productId = $this->product->getIdBySku($productSku);

        if ($productId) {
           
            $qty = $this->stockItemRepository->get($productId)->getQty();
            $id = $this->stockItemRepository->get($productId)->getId();
            $status = $this->product->load($productId)->getStatus();
            $name = $this->product->load($productId)->getName();
            $Type = $this->stockItemRepository->get($productId)->getTypeId();
            if($status==1){
            $output->writeln("<fg=green>
                              Product Details:
                              ProductId: {$id} 
                              ProductName: {$name}  
                              ProductSku: {$productSku}
                              Quantity: {$qty}  
                              Status: in stock
                              ProductType: {$Type} </>");
            }
            else{
                $output->writeln("<fg=red>
                     Product Details:       
                     ProductId: {$id} 
                     ProductName: {$name}  
                     ProductSku: {$productSku}
                     Quantity: {$qty}  
                     Status: outofstock
                     ProductType: {$Type} </>");

            }

        } else {
            $output->writeln("Product with SKU: {$productSku} not exist.");
        }
    }
}
