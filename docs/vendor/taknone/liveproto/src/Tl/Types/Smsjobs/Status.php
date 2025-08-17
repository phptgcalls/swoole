<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int recent_sent int recent_since int recent_remains int total_sent int total_since string terms_url true allow_international string last_gift_slug
 * @return smsjobs.Status
 */

final class Status extends Instance {
	public function request(int $recent_sent,int $recent_since,int $recent_remains,int $total_sent,int $total_since,string $terms_url,? true $allow_international = null,? string $last_gift_slug = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2aee9191);
		$flags = 0;
		$flags |= is_null($allow_international) ? 0 : (1 << 0);
		$flags |= is_null($last_gift_slug) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($recent_sent);
		$writer->writeInt($recent_since);
		$writer->writeInt($recent_remains);
		$writer->writeInt($total_sent);
		$writer->writeInt($total_since);
		if(is_null($last_gift_slug) === false):
			$writer->tgwriteBytes($last_gift_slug);
		endif;
		$writer->tgwriteBytes($terms_url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['allow_international'] = true;
		else:
			$result['allow_international'] = false;
		endif;
		$result['recent_sent'] = $reader->readInt();
		$result['recent_since'] = $reader->readInt();
		$result['recent_remains'] = $reader->readInt();
		$result['total_sent'] = $reader->readInt();
		$result['total_since'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['last_gift_slug'] = $reader->tgreadBytes();
		else:
			$result['last_gift_slug'] = null;
		endif;
		$result['terms_url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>