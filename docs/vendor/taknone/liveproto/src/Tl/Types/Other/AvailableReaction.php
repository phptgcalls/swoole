<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string reaction string title document static_icon document appear_animation document select_animation document activate_animation document effect_animation true inactive true premium document around_animation document center_icon
 * @return AvailableReaction
 */

final class AvailableReaction extends Instance {
	public function request(string $reaction,string $title,object $static_icon,object $appear_animation,object $select_animation,object $activate_animation,object $effect_animation,? true $inactive = null,? true $premium = null,? object $around_animation = null,? object $center_icon = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc077ec01);
		$flags = 0;
		$flags |= is_null($inactive) ? 0 : (1 << 0);
		$flags |= is_null($premium) ? 0 : (1 << 2);
		$flags |= is_null($around_animation) ? 0 : (1 << 1);
		$flags |= is_null($center_icon) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($reaction);
		$writer->tgwriteBytes($title);
		$writer->write($static_icon->read());
		$writer->write($appear_animation->read());
		$writer->write($select_animation->read());
		$writer->write($activate_animation->read());
		$writer->write($effect_animation->read());
		if(is_null($around_animation) === false):
			$writer->write($around_animation->read());
		endif;
		if(is_null($center_icon) === false):
			$writer->write($center_icon->read());
		endif;
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
		if($flags & (1 << 2)):
			$result['premium'] = true;
		else:
			$result['premium'] = false;
		endif;
		$result['reaction'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		$result['static_icon'] = $reader->tgreadObject();
		$result['appear_animation'] = $reader->tgreadObject();
		$result['select_animation'] = $reader->tgreadObject();
		$result['activate_animation'] = $reader->tgreadObject();
		$result['effect_animation'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['around_animation'] = $reader->tgreadObject();
		else:
			$result['around_animation'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['center_icon'] = $reader->tgreadObject();
		else:
			$result['center_icon'] = null;
		endif;
		return new self($result);
	}
}

?>