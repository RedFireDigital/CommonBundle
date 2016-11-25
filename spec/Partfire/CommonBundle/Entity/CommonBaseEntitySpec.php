<?php

namespace spec\PartFire\CommonBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommonBaseEntitySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('PartFire\CommonBundle\Entity\CommonBaseEntity');
    }

    public function it_should_generate_a_hash_of_length_twenty()
    {
        $this->getHashValue()->shouldBeString();
        $this->getHashValue()->shouldHaveLength(20);
    }

    public function it_should_generate_a_hash_of_length_three()
    {
        $this->getHashValue(3)->shouldBeString();
        $this->getHashValue(3)->shouldHaveLength(3);
    }

    public function it_should_sluggify_a_space_separated_string()
    {
        $this->sluggify("This is a test")->shouldBe("this-is-a-test");
        $this->sluggify("This is a test 88 *")->shouldBe("this-is-a-test-88");
    }

    public function it_should_provide_a_padded_id()
    {
        $this->setId(55);
        $this->getPaddedId()->shouldBeString();
        $this->getPaddedId()->shouldReturn("00000055");
        $this->getPaddedId(10)->shouldHaveLength(10);

    }

    public function getMatchers()
    {
        return [
            'haveLength' => function ($subject, $length) {
                return strlen($subject) === $length;
            }
        ];
    }
}
