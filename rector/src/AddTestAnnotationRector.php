<?php
declare(strict_types=1);
namespace Yahiru\RectorTutorialRector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPUnit\Framework\TestCase;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class AddTestAnnotationRector extends AbstractRector
{
    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition('Add @test annotation', [
            new CodeSample(
                <<<'CODE_SAMPLE'
                class SomeTest extends \PHPUnit\Framework\TestCase
                {
                    public function testSome() : void
                    {
                        // do test
                    }
                }
                CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
                class SomeTest extends \PHPUnit\Framework\TestCase
                {
                    /**
                     * @test
                     */
                    public function some() : void
                    {
                        // do test
                    }
                }
                CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (! $this->shouldRefactor($node)) {
            return null;
        }

        $phpDocInfo = $node->getAttribute(AttributeKey::PHP_DOC_INFO);
        if ($phpDocInfo === null) {
            $phpDocInfo = $this->phpDocInfoFactory->createEmpty($node);
        }

        $phpDocInfo->addBareTag('@test');

        $testName = \lcfirst(preg_replace('/\Atest/', '', $this->getName($node)));
        $node->name = new Node\Identifier($testName);

        return $node;
    }

    private function shouldRefactor(ClassMethod $node) : bool
    {
        $class = $node->getAttribute(AttributeKey::CLASS_NODE);

        return $node->isPublic()
            && $this->isName($node, 'test*')
            && $this->isObjectType($class, TestCase::class);
    }
}
