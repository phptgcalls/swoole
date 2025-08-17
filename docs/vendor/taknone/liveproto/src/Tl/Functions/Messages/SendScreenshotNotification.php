<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputreplyto reply_to long random_id
 * @return Updates
 */

final class SendScreenshotNotification extends Instance {
	public function request(object $peer,object $reply_to,int $random_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa1405817);
		$writer->write($peer->read());
		$writer->write($reply_to->read());
		$writer->writeLong($random_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>