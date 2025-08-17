<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int views_count true has_viewers int forwards_count Vector<ReactionCount> reactions int reactions_count Vector<long> recent_viewers
 * @return StoryViews
 */

final class StoryViews extends Instance {
	public function request(int $views_count,? true $has_viewers = null,? int $forwards_count = null,? array $reactions = null,? int $reactions_count = null,? array $recent_viewers = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8d595cd6);
		$flags = 0;
		$flags |= is_null($has_viewers) ? 0 : (1 << 1);
		$flags |= is_null($forwards_count) ? 0 : (1 << 2);
		$flags |= is_null($reactions) ? 0 : (1 << 3);
		$flags |= is_null($reactions_count) ? 0 : (1 << 4);
		$flags |= is_null($recent_viewers) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($views_count);
		if(is_null($forwards_count) === false):
			$writer->writeInt($forwards_count);
		endif;
		if(is_null($reactions) === false):
			$writer->tgwriteVector($reactions,'ReactionCount');
		endif;
		if(is_null($reactions_count) === false):
			$writer->writeInt($reactions_count);
		endif;
		if(is_null($recent_viewers) === false):
			$writer->tgwriteVector($recent_viewers,'long');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['has_viewers'] = true;
		else:
			$result['has_viewers'] = false;
		endif;
		$result['views_count'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['forwards_count'] = $reader->readInt();
		else:
			$result['forwards_count'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['reactions'] = $reader->tgreadVector('ReactionCount');
		else:
			$result['reactions'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['reactions_count'] = $reader->readInt();
		else:
			$result['reactions_count'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['recent_viewers'] = $reader->tgreadVector('long');
		else:
			$result['recent_viewers'] = null;
		endif;
		return new self($result);
	}
}

?>