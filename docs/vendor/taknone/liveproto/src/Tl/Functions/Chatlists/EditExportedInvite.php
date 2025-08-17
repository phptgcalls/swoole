<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchatlist chatlist string slug string title Vector<InputPeer> peers
 * @return ExportedChatlistInvite
 */

final class EditExportedInvite extends Instance {
	public function request(object $chatlist,string $slug,? string $title = null,? array $peers = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x653db63d);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($peers) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($chatlist->read());
		$writer->tgwriteBytes($slug);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($peers) === false):
			$writer->tgwriteVector($peers,'InputPeer');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>