<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call inputpeer join_as datajson params true muted true video_stopped string invite_hash int256 public_key bytes block
 * @return Updates
 */

final class JoinGroupCall extends Instance {
	public function request(object $call,object $join_as,object $params,? true $muted = null,? true $video_stopped = null,? string $invite_hash = null,? int | string $public_key = null,? string $block = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8fb53057);
		$flags = 0;
		$flags |= is_null($muted) ? 0 : (1 << 0);
		$flags |= is_null($video_stopped) ? 0 : (1 << 2);
		$flags |= is_null($invite_hash) ? 0 : (1 << 1);
		$flags |= is_null($public_key) ? 0 : (1 << 3);
		$flags |= is_null($block) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($call->read());
		$writer->write($join_as->read());
		if(is_null($invite_hash) === false):
			$writer->tgwriteBytes($invite_hash);
		endif;
		if(is_null($public_key) === false):
			$writer->writeLargeInt($public_key,256);
		endif;
		if(is_null($block) === false):
			$writer->tgwriteBytes($block);
		endif;
		$writer->write($params->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>