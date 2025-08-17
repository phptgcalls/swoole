<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int color_id true hidden help colors help dark_colors int channel_min_level int group_min_level
 * @return help.PeerColorOption
 */

final class PeerColorOption extends Instance {
	public function request(int $color_id,? true $hidden = null,? object $colors = null,? object $dark_colors = null,? int $channel_min_level = null,? int $group_min_level = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xadec6ebe);
		$flags = 0;
		$flags |= is_null($hidden) ? 0 : (1 << 0);
		$flags |= is_null($colors) ? 0 : (1 << 1);
		$flags |= is_null($dark_colors) ? 0 : (1 << 2);
		$flags |= is_null($channel_min_level) ? 0 : (1 << 3);
		$flags |= is_null($group_min_level) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeInt($color_id);
		if(is_null($colors) === false):
			$writer->write($colors->read());
		endif;
		if(is_null($dark_colors) === false):
			$writer->write($dark_colors->read());
		endif;
		if(is_null($channel_min_level) === false):
			$writer->writeInt($channel_min_level);
		endif;
		if(is_null($group_min_level) === false):
			$writer->writeInt($group_min_level);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['hidden'] = true;
		else:
			$result['hidden'] = false;
		endif;
		$result['color_id'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['colors'] = $reader->tgreadObject();
		else:
			$result['colors'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['dark_colors'] = $reader->tgreadObject();
		else:
			$result['dark_colors'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['channel_min_level'] = $reader->readInt();
		else:
			$result['channel_min_level'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['group_min_level'] = $reader->readInt();
		else:
			$result['group_min_level'] = null;
		endif;
		return new self($result);
	}
}

?>