<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id textwithentities title Vector<InputPeer> pinned_peers Vector<InputPeer> include_peers true has_my_invites true title_noanimate string emoticon int color
 * @return DialogFilter
 */

final class DialogFilterChatlist extends Instance {
	public function request(int $id,object $title,array $pinned_peers,array $include_peers,? true $has_my_invites = null,? true $title_noanimate = null,? string $emoticon = null,? int $color = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x96537bd7);
		$flags = 0;
		$flags |= is_null($has_my_invites) ? 0 : (1 << 26);
		$flags |= is_null($title_noanimate) ? 0 : (1 << 28);
		$flags |= is_null($emoticon) ? 0 : (1 << 25);
		$flags |= is_null($color) ? 0 : (1 << 27);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->write($title->read());
		if(is_null($emoticon) === false):
			$writer->tgwriteBytes($emoticon);
		endif;
		if(is_null($color) === false):
			$writer->writeInt($color);
		endif;
		$writer->tgwriteVector($pinned_peers,'InputPeer');
		$writer->tgwriteVector($include_peers,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 26)):
			$result['has_my_invites'] = true;
		else:
			$result['has_my_invites'] = false;
		endif;
		if($flags & (1 << 28)):
			$result['title_noanimate'] = true;
		else:
			$result['title_noanimate'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['title'] = $reader->tgreadObject();
		if($flags & (1 << 25)):
			$result['emoticon'] = $reader->tgreadBytes();
		else:
			$result['emoticon'] = null;
		endif;
		if($flags & (1 << 27)):
			$result['color'] = $reader->readInt();
		else:
			$result['color'] = null;
		endif;
		$result['pinned_peers'] = $reader->tgreadVector('InputPeer');
		$result['include_peers'] = $reader->tgreadVector('InputPeer');
		return new self($result);
	}
}

?>