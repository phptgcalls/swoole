<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel true for_profile int color long background_emoji_id
 * @return Updates
 */

final class UpdateColor extends Instance {
	public function request(object $channel,? true $for_profile = null,? int $color = null,? int $background_emoji_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd8aa3671);
		$flags = 0;
		$flags |= is_null($for_profile) ? 0 : (1 << 1);
		$flags |= is_null($color) ? 0 : (1 << 2);
		$flags |= is_null($background_emoji_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		if(is_null($color) === false):
			$writer->writeInt($color);
		endif;
		if(is_null($background_emoji_id) === false):
			$writer->writeLong($background_emoji_id);
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