<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchatlist chatlist string title Vector<InputPeer> peers
 * @return chatlists.ExportedChatlistInvite
 */

final class ExportChatlistInvite extends Instance {
	public function request(object $chatlist,string $title,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8472478e);
		$writer->write($chatlist->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($peers,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>