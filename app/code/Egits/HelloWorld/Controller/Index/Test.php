<?php
namespace Egits\HelloWorld\Controller\Index;
use Egits\HelloWorld\Model\PostFactory;
class Test extends \Magento\Framework\App\Action\Action
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->_postFactory->create();
        $data = $post->getCollection();
//        $values='Sample Text 1 for Data 12';
//        $a = 13;
//        $value = $post->load($a);
//        $value->setTitle("Sample Text 1 for Data 10");
//        $value->setBlock_id(3);
//        $value->save();
//        $value->delete();
//        $post->setTitle($a)->save();
        echo "<table border='1 '><tr><th>SlNo</th><th>Content</th><th>ID</th><th>Updated At</th></tr>";
        $i = 1;
        foreach($data as $value)
		{
            echo "<tr><td>".$i."</td>";
            echo "<td>".$value->getTitle()."</td>";
            echo "<td>".$value->getId()."</td>";
            echo "<td>".$value->getDate_closed()."</td>";
            echo "</tr>";
//            echo ($value->getId());
//            echo ($value->getTitle());
//            echo ($value->getDate_closed());
            $i = $i+1;
		}
        echo "</table>";
//         echo "Hello World";
        // exit;
//        $sampleData = [
//            [
//                'severity' => 1,
//                'title' => 'Sample Text 1 for Data 4',
//                'block_id' => 5
//            ],
//            [
//                'severity' => 1,
//                'title' => 'Sample Text 1 for Data 5',
//                'block_id' => 6
//            ]
//        ];
//        foreach ($sampleData as $data) {
//            $this->_postFactory->create()->setData($data)->save();
//        }

    }
//
//
//
    }

