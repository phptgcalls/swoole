<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int random_id true muted true video_stopped true join int256 public_key bytes block datajson params
 * @return Updates
 */

final class CreateConferenceCall extends Instance {
	public function request(int $random_id,? true $muted = null,? true $video_stopped = null,? true $join = null,? int | string $public_key = null,? string $block = null,? object $params = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d0444bb);
		$flags = 0;
		$flags |= is_null($muted) ? 0 : (1 << 0);
		$flags |= is_null($video_stopped) ? 0 : (1 << 2);
		$flags |= is_null($join) ? 0 : (1 << 3);
		$flags |= is_null($public_key) ? 0 : (1 << 3);
		$flags |= is_null($block) ? 0 : (1 << 3);
		$flags |= is_null($params) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($random_id);
		if(is_null($public_key) === false):
			$writer->writeLargeInt($public_key,256);
		endif;
		if(is_null($block) === false):
			$writer->tgwriteBytes($block);
		endif;
		if(is_null($params) === false):
			$writer->write($params->read());
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