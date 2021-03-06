<?php

declare(strict_types=1);

namespace Rector\FileSystemRector\Parser;

use PhpParser\Node;
use Rector\NodeTypeResolver\NodeScopeAndMetadataDecorator;
use Rector\PhpParser\Parser\Parser;
use Symplify\PackageBuilder\FileSystem\SmartFileInfo;

final class FileInfoParser
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var NodeScopeAndMetadataDecorator
     */
    private $nodeScopeAndMetadataDecorator;

    public function __construct(Parser $parser, NodeScopeAndMetadataDecorator $nodeScopeAndMetadataDecorator)
    {
        $this->parser = $parser;
        $this->nodeScopeAndMetadataDecorator = $nodeScopeAndMetadataDecorator;
    }

    /**
     * @return Node[]
     */
    public function parseFileInfoToNodesAndDecorate(SmartFileInfo $fileInfo): array
    {
        $oldStmts = $this->parser->parseFile($fileInfo->getRealPath());

        return $this->nodeScopeAndMetadataDecorator->decorateNodesFromFile($oldStmts, $fileInfo->getRealPath());
    }

    /**
     * @return Node[]
     */
    public function parseFileInfoToNodesAndDecorateWithScope(SmartFileInfo $fileInfo): array
    {
        $oldStmts = $this->parser->parseFile($fileInfo->getRealPath());

        return $this->nodeScopeAndMetadataDecorator->decorateNodesFromFile($oldStmts, $fileInfo->getRealPath(), true);
    }
}
