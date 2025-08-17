<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer reportreason reason string message
 * @return Bool
 */

final class ReportPeer extends Instance {
	public function request(object $peer,object $reason,string $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc5ba3d86);
		$writer->write($peer->read());
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