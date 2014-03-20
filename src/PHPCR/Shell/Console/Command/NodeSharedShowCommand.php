<?php

namespace PHPCR\Shell\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use PHPCR\Util\CND\Writer\CndWriter;
use PHPCR\NodeType\NoSuchNodeTypeException;
use PHPCR\Util\CND\Parser\CndParser;
use PHPCR\NamespaceException;
use Symfony\Component\Console\Input\InputOption;

class NodeSharedShowCommand extends Command
{
    protected function configure()
    {
        $this->setName('node:shared:show');
        $this->setDescription('Show all the nodes are in the shared set of this node');
        $this->setHelp(<<<HERE
Lists all nodes that are in the shared set of this node.

Shareable nodes are analagous to symbolic links in a linux filesystem and can
be created by cloning a node within the same workspace.

If this node is not shared then only this node is shown.
HERE
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $session = $this->getHelper('phpcr')->getSession();
        $currentNode = $session->getCurrentNode();
        $sharedSet = $currentNode->getSharedSet();

        foreach ($sharedSet as $sharedNode) {
            $output->writeln($sharedNode->getPath());
        }
    }
}