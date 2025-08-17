<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id string short_name Vector<AttachMenuBotIcon> icons true inactive true has_settings true request_write_access true show_in_attach_menu true show_in_side_menu true side_menu_disclaimer_needed Vector<AttachMenuPeerType> peer_types
 * @return AttachMenuBot
 */

final class AttachMenuBot extends Instance {
	public function request(int $bot_id,string $short_name,array $icons,? true $inactive = null,? true $has_settings = null,? true $request_write_access = null,? true $show_in_attach_menu = null,? true $show_in_side_menu = null,? true $side_menu_disclaimer_needed = null,? array $peer_types = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd90d8dfe);
		$flags = 0;
		$flags |= is_null($inactive) ? 0 : (1 << 0);
		$flags |= is_null($has_settings) ? 0 : (1 << 1);
		$flags |= is_null($request_write_access) ? 0 : (1 << 2);
		$flags |= is_null($show_in_attach_menu) ? 0 : (1 << 3);
		$flags |= is_null($show_in_side_menu) ? 0 : (1 << 4);
		$flags |= is_null($side_menu_disclaimer_needed) ? 0 : (1 << 5);
		$flags |= is_null($peer_types) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($short_name);
		if(is_null($peer_types) === false):
			$writer->tgwriteVector($peer_types,'AttachMenuPeerType');
		endif;
		$writer->tgwriteVector($icons,'AttachMenuBotIcon');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['inactive'] = true;
		else:
			$result['inactive'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['has_settings'] = true;
		else:
			$result['has_settings'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['request_write_access'] = true;
		else:
			$result['request_write_access'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['show_in_attach_menu'] = true;
		else:
			$result['show_in_attach_menu'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['show_in_side_menu'] = true;
		else:
			$result['show_in_side_menu'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['side_menu_disclaimer_needed'] = true;
		else:
			$result['side_menu_disclaimer_needed'] = false;
		endif;
		$result['bot_id'] = $reader->readLong();
		$result['short_name'] = $reader->tgreadBytes();
		if($flags & (1 << 3)):
			$result['peer_types'] = $reader->tgreadVector('AttachMenuPeerType');
		else:
			$result['peer_types'] = null;
		endif;
		$result['icons'] = $reader->tgreadVector('AttachMenuBotIcon');
		return new self($result);
	}
}

?>