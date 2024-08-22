<?php

namespace App\Context;

use App\DateTime\ClockInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
final class TimeBasedChannelContext implements ChannelContextInterface

{
    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    /** @var ClockInterface */
    private $clock;

    public function __construct(ChannelRepositoryInterface $channelRepository, ClockInterface $clock)
    {
        $this->channelRepository = $channelRepository;
        $this->clock = $clock;
    }

    public function getChannel(): ChannelInterface
    {
        $channel = $this->clock->isNight()
            ? $this->channelRepository->findOneByCode('NIGHT')
            : $this->channelRepository->findOneBy([]);

        if (null === $channel) {
            throw new \RuntimeException('No channel found');
        }
        return $channel;
    }

}
