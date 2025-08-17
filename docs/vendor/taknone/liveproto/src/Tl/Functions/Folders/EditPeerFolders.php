<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Folders;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputFolderPeer> folder_peers
 * @return Updates
 */

final class EditPeerFolders extends Instance {
	public function request(array $folder_peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6847d0ab);
		$writer->tgwriteVector($folder_peers,'InputFolderPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>