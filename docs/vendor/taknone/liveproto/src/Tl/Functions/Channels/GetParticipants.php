<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel channelparticipantsfilter filter int offset int limit long hash
 * @return channels.ChannelParticipants
 */

final class GetParticipants extends Instance {
	public function request(object $channel,object $filter,int $offset,int $limit,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77ced9d0);
		$writer->write($channel->read());
		$writer->write($filter->read());
		$writer->writeInt($offset);
		$writer->writeInt($limit);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>