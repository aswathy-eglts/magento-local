<?php
namespace Egits\QrCode\Observer;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

use Magento\Sales\Api\OrderRepositoryInterface;

class Order implements \Magento\Framework\Event\ObserverInterface
{


    protected $orderRepository;
    protected $_filesystem;
    private $layout;
    private $io;
    protected $_messageManager;
    protected $logger;

    /**
     * @var \Magento\Framework\Filesystem
     */
    private \Magento\Framework\Filesystem $filesystem;

    public function __construct(
        Action\Context $context,

        OrderRepositoryInterface $OrderRepositoryInterface,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\View\Layout $layout,
        \Magento\Framework\Filesystem\Io\File $io,
        \Magento\Framework\Filesystem\DirectoryList $dir,
        \Magento\Framework\Message\ManagerInterface $_messageManager,
        \Egits\QrCode\Logger\Logger $logger

    )
    {
        $this->orderRepository = $OrderRepositoryInterface;
        $this->filesystem = $filesystem;
        $this->layout = $layout;
        $this->io= $io;
        $this->directoryList = $dir;
        $this->_messageManager = $_messageManager;
        $this->logger = $logger; 
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $order = $observer->getEvent()->getOrder();
        $order_id = $order->getIncrementId();

        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($order_id )
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(200)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(__DIR__.'/assets/symfony.png')
            ->setResizeToWidth(50);

        // Create generic label
        $label = Label::create('Label')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $mediapath = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $this->io->mkdir($this->directoryList->getPath('media').'/qrcode', 0777);
        try
        {
            $result->saveToFile($mediapath . 'qrcode/'. $order_id .'.png');
            $dataUri = $result->getDataUri();
        }
        catch (\Exception $e) 
        {
          $this->logger->warning('Something went wrong while uploading the QrCode'.'. '.$e->getMessage());

        }

    }
}
