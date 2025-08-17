<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int msg_id
 * @return Bool
 */

final class ReportAntiSpamFalsePositive extends Instance {
	public function request(object $channel,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa850a693);
		$writer->write($channel->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>