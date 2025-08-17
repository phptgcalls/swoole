<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call true start true video string title bool video_portrait
 * @return Updates
 */

final class ToggleGroupCallRecord extends Instance {
	public function request(object $call,? true $start = null,? true $video = null,? string $title = null,? bool $video_portrait = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf128c708);
		$flags = 0;
		$flags |= is_null($start) ? 0 : (1 << 0);
		$flags |= is_null($video) ? 0 : (1 << 2);
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($video_portrait) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($call->read());
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($video_portrait) === false):
			$writer->tgwriteBool($video_portrait);
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