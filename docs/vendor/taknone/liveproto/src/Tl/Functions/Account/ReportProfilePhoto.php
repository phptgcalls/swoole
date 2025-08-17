<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputphoto photo_id reportreason reason string message
 * @return Bool
 */

final class ReportProfilePhoto extends Instance {
	public function request(object $peer,object $photo_id,object $reason,string $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa8cc6f5);
		$writer->write($peer->read());
		$writer->write($photo_id->read());
		$writer->write($reason->read());
		$writer->tgwriteBytes($message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>