<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string emoticon long effect_sticker_id true premium_required long static_icon_id long effect_animation_id
 * @return AvailableEffect
 */

final class AvailableEffect extends Instance {
	public function request(int $id,string $emoticon,int $effect_sticker_id,? true $premium_required = null,? int $static_icon_id = null,? int $effect_animation_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93c3e27e);
		$flags = 0;
		$flags |= is_null($premium_required) ? 0 : (1 << 2);
		$flags |= is_null($static_icon_id) ? 0 : (1 << 0);
		$flags |= is_null($effect_animation_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($emoticon);
		if(is_null($static_icon_id) === false):
			$writer->writeLong($static_icon_id);
		endif;
		$writer->writeLong($effect_sticker_id);
		if(is_null($effect_animation_id) === false):
			$writer->writeLong($effect_animation_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['premium_required'] = true;
		else:
			$result['premium_required'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['emoticon'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['static_icon_id'] = $reader->readLong();
		else:
			$result['static_icon_id'] = null;
		endif;
		$result['effect_sticker_id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['effect_animation_id'] = $reader->readLong();
		else:
			$result['effect_animation_id'] = null;
		endif;
		return new self($result);
	}
}

?>