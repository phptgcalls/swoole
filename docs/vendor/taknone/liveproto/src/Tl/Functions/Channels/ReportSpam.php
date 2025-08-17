<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputpeer participant Vector<int> id
 * @return Bool
 */

final class ReportSpam extends Instance {
	public function request(object $channel,object $participant,array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf44a8315);
		$writer->write($channel->read());
		$writer->write($participant->read());
		$writer->tgwriteVector($id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>