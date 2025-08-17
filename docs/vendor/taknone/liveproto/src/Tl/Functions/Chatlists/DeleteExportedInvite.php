<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchatlist chatlist string slug
 * @return Bool
 */

final class DeleteExportedInvite extends Instance {
	public function request(object $chatlist,string $slug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x719c5c5e);
		$writer->write($chatlist->read());
		$writer->tgwriteBytes($slug);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>