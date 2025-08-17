<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string link
 * @return Bool
 */

final class DeleteExportedChatInvite extends Instance {
	public function request(object $peer,string $link) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd464a42b);
		$writer->write($peer->read());
		$writer->tgwriteBytes($link);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>