<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<FolderPeer> folder_peers int pts int pts_count
 * @return Update
 */

final class UpdateFolderPeers extends Instance {
	public function request(array $folder_peers,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x19360dc0);
		$writer->tgwriteVector($folder_peers,'FolderPeer');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['folder_peers'] = $reader->tgreadVector('FolderPeer');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>