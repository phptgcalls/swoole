<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id textwithentities title Vector<InputPeer> pinned_peers Vector<InputPeer> include_peers Vector<InputPeer> exclude_peers true contacts true non_contacts true groups true broadcasts true bots true exclude_muted true exclude_read true exclude_archived true title_noanimate string emoticon int color
 * @return DialogFilter
 */

final class DialogFilter extends Instance {
	public function request(int $id,object $title,array $pinned_peers,array $include_peers,array $exclude_peers,? true $contacts = null,? true $non_contacts = null,? true $groups = null,? true $broadcasts = null,? true $bots = null,? true $exclude_muted = null,? true $exclude_read = null,? true $exclude_archived = null,? true $title_noanimate = null,? string $emoticon = null,? int $color = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaa472651);
		$flags = 0;
		$flags |= is_null($contacts) ? 0 : (1 << 0);
		$flags |= is_null($non_contacts) ? 0 : (1 << 1);
		$flags |= is_null($groups) ? 0 : (1 << 2);
		$flags |= is_null($broadcasts) ? 0 : (1 << 3);
		$flags |= is_null($bots) ? 0 : (1 << 4);
		$flags |= is_null($exclude_muted) ? 0 : (1 << 11);
		$flags |= is_null($exclude_read) ? 0 : (1 << 12);
		$flags |= is_null($exclude_archived) ? 0 : (1 << 13);
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
		$writer->tgwriteVector($exclude_peers,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['contacts'] = true;
		else:
			$result['contacts'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['non_contacts'] = true;
		else:
			$result['non_contacts'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['groups'] = true;
		else:
			$result['groups'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['broadcasts'] = true;
		else:
			$result['broadcasts'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['bots'] = true;
		else:
			$result['bots'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['exclude_muted'] = true;
		else:
			$result['exclude_muted'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['exclude_read'] = true;
		else:
			$result['exclude_read'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['exclude_archived'] = true;
		else:
			$result['exclude_archived'] = false;
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
		$result['exclude_peers'] = $reader->tgreadVector('InputPeer');
		return new self($result);
	}
}

?>